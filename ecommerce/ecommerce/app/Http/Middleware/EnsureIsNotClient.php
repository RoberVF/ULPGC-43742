<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsNotClient
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->isClient()) {
            abort(403);
        }
        return $next($request);
    }
}