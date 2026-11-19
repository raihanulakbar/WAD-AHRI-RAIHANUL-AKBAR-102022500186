<?php

use App\Http\Middleware\EnsureUserRole;
use App\Http\Middleware\LogRequestMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 1. Alias supaya bisa dipanggil singkat di routes/web.php
        $middleware->alias([
            'role'        => EnsureUserRole::class,
            'log.request' => LogRequestMiddleware::class,
        ]);

        // 2. Global middleware untuk semua rute web
        $middleware->web(append: [
            LogRequestMiddleware::class,
        ]);

        // 3. Tujuan redirect otomatis
        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));
        $middleware->redirectUsersTo(fn (Request $request) => route('fasilitas.index'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();