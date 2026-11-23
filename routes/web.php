<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman utama -> daftar reservasi
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Tiap baris di bawah otomatis membuat alamat + nama route yang dipakai di view
Route::resource('tipe-kamar', TipeKamarController::class)->only(['index', 'store', 'destroy']);
Route::resource('kamar',      KamarController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('tamu',       TamuController::class)->only(['index', 'store', 'destroy']);
Route::resource('reservasi',  ReservasiController::class)->only(['index', 'create', 'store', 'update', 'destroy']);
