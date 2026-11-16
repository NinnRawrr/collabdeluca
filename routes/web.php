<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\TipeKamarController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('reservasi', ReservasiController::class);
Route::resource('kamar', KamarController::class);
Route::resource('tamu', TamuController::class);
Route::resource('tipe-kamar', TipeKamarController::class);