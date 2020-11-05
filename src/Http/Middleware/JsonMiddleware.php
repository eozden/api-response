<?php

namespace Eozden\ApiResponse\Http\Middleware;

use Closure;

class JsonMiddleware
{
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
