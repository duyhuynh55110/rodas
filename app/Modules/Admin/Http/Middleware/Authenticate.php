<?php

namespace App\Modules\Admin\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

/**
 * Authenticate middleware
 */
class Authenticate extends Middleware
{
    /**
     * Get the path user should be redirected to when they are not authenticated.
     *
     * @param Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(!$request->expectsJson()) {
            return routeAdmin('login');
        }
    }
}
