<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\MejaController;
use Illuminate\Support\Facades\Route;

// 1. Guest + Throttle (batasi percobaan login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:20,1'); // maks 20 percobaan per 1 menit

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 2. Wajib login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::redirect('/', '/fasilitas');

    // 3. Admin DAN user: hanya boleh LIHAT
    Route::middleware('role:admin,user')->group(function () {
        Route::resource('fasilitas', FasilitasController::class)
            ->parameters(['fasilitas' => 'fasilitas'])
            ->only('index');

        Route::resource('area', MejaController::class)
            ->parameters(['area' => 'meja'])
            ->only('index');
    });

    // 4. Khusus admin: tambah, edit, hapus
    Route::middleware('role:admin')->group(function () {
        Route::resource('fasilitas', FasilitasController::class)
            ->parameters(['fasilitas' => 'fasilitas'])
            ->except(['index', 'show']);

        Route::resource('area', MejaController::class)
            ->parameters(['area' => 'meja'])
            ->except(['index', 'show']);
    });
});