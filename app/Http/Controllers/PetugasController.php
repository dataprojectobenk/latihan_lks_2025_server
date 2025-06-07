<?php

namespace App\Http\Controllers;


use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard("api")->attempt($request->only(["username", "password"]))) {
            $token = Auth::guard("api")->user()->createToken("lks_2025", ["*"], now()->addDay());
            return response()->json([
                "token" => $token->plainTextToken,
                "data" => Auth::guard("api")->user(),
                "expires_at" => $token->accessToken->expires_at
            ], 200);
        }

        return response()->json(['pesan' => 'Data salah'], 401);
    }

    public function daftar(Request $request){
        $request->validate([
            'namaLengkap'=>'required',
            'alamat'=>'required',
            'username'=>'required|unique:petugas',
            'password'=> 'required',
            'konfirmasiPassword'=>'required|same:password'
        ]);
        // save petugas
        $petugas = new Petugas();
        $save = $petugas->create($request->only(['namaLengkap','alamat','username','password']));
        if($save){
            return response()->json(['pesan'=>'Data berhasil disimpan!','petugas'=>$save],200);
        }
        return response()->json(['pesan'=>'Data gagal disimpan'],401);
    }
}
