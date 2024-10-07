<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsVerified
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->verification_code) {
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
