<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsSeller
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isSeller()) {
            abort(403, 'Acceso restringido a vendedores.');
        }
        return $next($request);
    }
}