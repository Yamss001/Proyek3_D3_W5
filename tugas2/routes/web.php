<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;

Route::get('/', [KeranjangController::class, 'index']);

Route::get('/index', [KeranjangController::class, 'index'])
    ->name('index');

Route::get('/keranjang', [KeranjangController::class, 'keranjang'])
    ->name('keranjang');

Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])
    ->name('keranjang.tambah');

Route::post('/keranjang/ubah/{id}', [KeranjangController::class, 'ubahJumlah'])
    ->name('keranjang.ubah');

Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])
    ->name('keranjang.hapus');

Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])
    ->name('keranjang.kosongkan');