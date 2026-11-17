<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\MejaController;
use Illuminate\Support\Facades\Route;

// ===== Hanya untuk yang BELUM login =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ===== Logout =====
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ===== Hanya untuk yang SUDAH login =====
Route::middleware('auth')->group(function () {
    Route::redirect('/', '/fasilitas');

    // Halaman 1: Fasilitas  -> /fasilitas
    Route::resource('fasilitas', FasilitasController::class)
        ->parameters(['fasilitas' => 'fasilitas'])
        ->except('show');

    // Halaman 2: Area (data meja) -> /area
    Route::resource('area', MejaController::class)
        ->parameters(['area' => 'meja'])
        ->except('show');
});