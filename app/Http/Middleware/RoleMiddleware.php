<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        // Mendukung multi role, misal: role:admin,owner
        $rolesArray = explode(',', $roles);

        if (Auth::check() && in_array(Auth::user()->role, $rolesArray)) {
             return $next($request);
            // dd(Auth::user()->role); // Debugging line to check the role 
        }

        return redirect()->route('login')->with('error', 'Akses ditolak! Anda tidak memiliki akses.');
    }
}

