<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\TipeKamarController;
<<<<<<< HEAD
use Illuminate\Support\Facades\Route;

// Halaman utama -> daftar reservasi
Route::get('/', function () {
    return redirect()->route('reservasi.index');
});
=======
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman utama -> daftar reservasi
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
>>>>>>> 84939fed8a05d3cad6fbd204036119ea83597e9b

// Tiap baris di bawah otomatis membuat alamat + nama route yang dipakai di view
Route::resource('tipe-kamar', TipeKamarController::class)->only(['index', 'store', 'destroy']);
Route::resource('kamar',      KamarController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('tamu',       TamuController::class)->only(['index', 'store', 'destroy']);
Route::resource('reservasi',  ReservasiController::class)->only(['index', 'create', 'store', 'update', 'destroy']);
