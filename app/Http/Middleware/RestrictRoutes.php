<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictRoutes
{
    public function handle(Request $request, Closure $next)
    {
        $allowedRoutes = ['/register'];
        if (! in_array($request->path(), $allowedRoutes)) {
            abort(404);
        }

        return $next($request);
    }
}
