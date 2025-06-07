<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $guarded=[];

    // function relasi
    public function transaksi(){
        return $this->hasMany(Transaksi::class,'petugas_id','id');
    }
}
