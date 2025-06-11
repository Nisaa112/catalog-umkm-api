<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

Route::get('/products', [ProdukController::class, 'getProduk']);
Route::get('/kategori', [KategoriController::class, 'getKategori']);