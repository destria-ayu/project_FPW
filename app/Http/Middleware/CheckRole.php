<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            // Mengembalikan view kustom
            return response()->view('errors.403_kustom', [
                'message' => 'Akses Ditolak! Akun Anda (' . strtoupper($request->user()->role) . ') tidak diizinkan mengakses halaman ini.'
            ], 403);
        }

        return $next($request);
    }
}