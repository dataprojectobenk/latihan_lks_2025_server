<?php

use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProdukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [PetugasController::class, 'login']);


Route::get('logout', [PetugasController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProdukController::class)->group(function () {
        Route::prefix('produk')->group(function () {
            Route::get('', 'index');
            Route::get('detail/{id}', 'show');
        });
    });
});