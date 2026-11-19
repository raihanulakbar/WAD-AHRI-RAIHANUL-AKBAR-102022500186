<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // 1. Belum login -> ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // 2. Role user tidak ada di daftar yang diizinkan -> 403
        if ($roles === [] || ! in_array($user->role, $roles, true)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Akses ditolak. Akun kamu tidak punya izin.',
                ], Response::HTTP_FORBIDDEN);
            }

            abort(Response::HTTP_FORBIDDEN, 'Akses ditolak.');
        }

        // 3. Lolos -> lanjut ke Controller
        return $next($request);
    }
}