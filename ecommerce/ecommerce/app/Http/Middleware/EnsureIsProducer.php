<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsProducer
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isProducer()) {
            abort(403, 'Acceso restringido a productores.');
        }
        return $next($request);
    }
}