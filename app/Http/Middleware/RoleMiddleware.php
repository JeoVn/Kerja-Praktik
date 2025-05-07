<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Mengecek apakah pengguna sudah login dan memiliki role yang sesuai
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika tidak memiliki role yang sesuai, redirect dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Anda bukan Owner.');
    }
}

