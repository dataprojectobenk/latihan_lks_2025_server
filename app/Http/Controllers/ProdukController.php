<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return response()->json(Produk::all(),200);
    }

    public function show($id){
        return response()->json(Produk::find($id),200);
    }
}
