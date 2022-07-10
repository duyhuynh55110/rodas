<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'App\Modules\Admin\Http\Controllers',
        // 'domain' => env('APP_ADMIN_DOMAIN'),
        'as' => ADMIN_MODULE_AS,
        'middleware' => ['web'],
    ],
    function () {
        // Authentication
        Route::group(
            [
                'namespace' => 'Auth'
            ],
            function () {
                Route::name('login')->get('/login', 'LoginController@login');
                Route::name('authenticate')->post('/authenticate', 'LoginController@authenticate');
                Route::name('logout')->get('/logout', 'LogoutController@logout');
            }
        );

        // Admin group
        Route::group(
            [
                'middleware' => 'auth.admin:' . ADMIN_GUARD,
            ],
            function () {
                // Homepage
                Route::name('home')->get(
                    '/',
                    function () {
                        return 'Login successfully';
                    }
                );
            }
        );
    }
);
