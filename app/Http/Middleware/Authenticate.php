<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika pengguna belum terautentikasi, arahkan ke halaman login
        if (!Auth::check()) {
            return $request->expectsJson() ? null : route('login');
        }

        // Jika pengguna sudah login, arahkan berdasarkan role mereka
        $user = Auth::user();
        if ($user->role === 'owner') {
            return route('owner.home');
        } elseif ($user->role === 'admin') {
            return route('admin.home');
        }

        // Default pengalihan jika role tidak ditemukan
        return route('login');
    }
}
