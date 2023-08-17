<?php

namespace App\Modules\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Force return json
 */
class ResponseWithJsonMiddleware
{
    /**
     * Handle an incoming request
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
