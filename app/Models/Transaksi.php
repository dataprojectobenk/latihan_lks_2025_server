<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded=[];


    // function relasi
    public function petugas(){
        return $this->belongsTo(Petugas::class,'petugas_id','id');
    }

    public function detailTransaksi(){
        return $this->hasMany(DetailTransaksi::class,'transaksi_id','id');
    }

    public function produk(){
        return $this->belongsToMany(Produk::class,'detail_transaksis','transaksi_id','produk_id');
    }
}
