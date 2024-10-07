<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Jika pengguna tidak memiliki peran yang sesuai, redirect
            return redirect('/');
        }

        return $next($request);
    }
}
