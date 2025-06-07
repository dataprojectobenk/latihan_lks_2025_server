<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Transaksi;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isArray;

class TransaksiController extends Controller
{
    public function index(Request $request){
        $request->validate([
            "*.produk_id"=>'required',
            "*.jumlah"=>'required'
        ]);
        $petugas = $request->user();
        $transaksi = $petugas->transaksi()->create(['tanggal'=>date('Y-m-d')]);

        // save data item transaksi
        $transaksi->detailTransaksi()->createMany($request->all());

        // Ambil detail transaksi beserta data produk (termasuk harga)
        $detail = $transaksi->detailTransaksi()->with('produk')->get();

        // Format response agar harga produk dan subtotal ikut ditampilkan
        $response = $detail->map(function($item) {
            return [
                'produk_id' => $item->produk_id,
                'jumlah' => $item->jumlah,
                'harga' => $item->produk->harga,
                'subtotal' => $item->jumlah * $item->produk->harga
            ];
        });

        // Hitung total bayar
        $totalHarga = $response->sum('subtotal');

        // Simpan total bayar ke transaksi
        $transaksi->totalHarga = $totalHarga;
        $transaksi->save();

        return response()->json([
            'transaksi_id' => $transaksi->id,
            'tanggal' => $transaksi->tanggal,
            'detail' => $response,
            'total_bayar' => $totalHarga
        ]);
    }
}
