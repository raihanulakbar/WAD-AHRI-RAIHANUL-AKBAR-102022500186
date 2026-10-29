<?php

use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\MejaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/fasilitas');

// Halaman 1: Fasilitas  -> /fasilitas
Route::resource('fasilitas', FasilitasController::class)
    ->parameters(['fasilitas' => 'fasilitas'])
    ->except('show');

// Halaman 2: Area (data meja) -> /area
Route::resource('area', MejaController::class)
    ->parameters(['area' => 'meja'])
    ->except('show');