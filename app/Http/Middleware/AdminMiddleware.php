<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
   public function handle($request, Closure $next)
{
    if (strtolower(auth()->user()->role) !== 'admin') {
        abort(403, 'Akses hanya untuk admin.');
    }

    return $next($request);
}
}
