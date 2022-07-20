<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('routeAdmin')) {
    /**
     * Get route for admin
     *
     * @param string $name
     * @param array $options
     * @return string|null
     */
    function routeAdmin($name, $options = [])
    {
        return route(ADMIN_MODULE_AS . $name, $options);
    }
}

if (!function_exists('authAdmin')) {
    /**
     * Get auth guard for admin
     *
     * @param string $guard
     * @return string|null
     */
    function authAdmin($guard = '') : Illuminate\Auth\SessionGuard
    {
        $guard = empty($guard) ? ADMIN_GUARD : $guard;
        return Auth::guard($guard);
    }
}

if (!function_exists('assetAdmin')) {
    /**
     * Get asset link for admin
     *
     * @param string $url url path.
     * @param boolean $http flag for return http(s) or none http(s)
     * @return string
     */
    function assetAdmin($url, $http = true): string
    {
        // remove '/' at first character when have
        if (strpos($url, '/') == 0) {
            $url = substr($url, 1);
        }

        $assetPath = ADMIN_ASSET_PATH . $url;

        return ($http ? mix($assetPath) : $assetPath);
    }
}
