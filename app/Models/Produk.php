<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $guarded=[];

    // function relasi
    public function detailTransaksi(){
        return $this->hasMany(DetailTransaksi::class,"produk_id","id");
    }
}
