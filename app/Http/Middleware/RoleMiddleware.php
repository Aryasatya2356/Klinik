<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user yang login memiliki role yang sesuai
        if ($request->user()->role !== $role) {
            // Jika beda, tampilkan error 403 (Forbidden)
            abort(403, 'Akses Ditolak! Anda bukan ' . ucfirst($role));
        }

        return $next($request);
    }
}
