<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $guarded=[];

    // function relasi

    public function produk(){
        return $this->belongsTo(Produk::class,'produk_id','id');
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class,'transaksi_id','id');
    }
    
}
