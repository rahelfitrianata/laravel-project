<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    // Middleware untuk mengatur akses admin, jadi hanya admin role 1 yang bisa memiliki akses sebagai admin
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have admin access.');
    }

}
