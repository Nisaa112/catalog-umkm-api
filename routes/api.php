<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\umkmController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::apiResource('produk', ProdukController::class);
Route::apiResource('kategori', KategoriController::class);
Route::apiResource('umkm', umkmController::class);


// Route::get('/api/test', function () {
//     return response()->json(['status' => 'API OK']);
// });
