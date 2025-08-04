<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
     public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('/login'); // Redirect ke halaman login jika belum login
        }

        // Cek apakah user memiliki salah satu role yang diberikan
        foreach ($roles as $role) {
            if (auth()->user()->hasRole($role)) {
                return $next($request);
            }
        }

        // Jika tidak ada role yang cocok, tampilkan error
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

}

