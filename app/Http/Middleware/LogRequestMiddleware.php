<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jalankan request ke controller dulu
        $response = $next($request);

        // Setelah selesai, catat ke storage/logs/laravel.log
        Log::info('HTTP request processed', [
            'method'    => $request->method(),
            'path'      => '/' . ltrim($request->path(), '/'),
            'user_id'   => $request->user()?->id,
            'status'    => $response->getStatusCode(),
            'timestamp' => now()->toIso8601String(),
        ]);

        return $response;
    }
}