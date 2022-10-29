<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'domain' => env('APP_API_DOMAIN'),
        'as' => API_MODULE_AS,
        'middleware' => ['api', 'response.json'],
    ],
    function () {
        // Homepage
        Route::name('home')->get(
            '/',
            function () {
                return response()->json([
                    'message' => 'OK',
                    'status' => 200,
                ]);
            }
        );
    }
);
