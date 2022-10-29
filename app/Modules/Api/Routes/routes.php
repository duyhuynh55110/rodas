<?php

use App\Modules\Api\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'domain' => env('APP_API_DOMAIN'),
        'as' => API_MODULE_AS,
        'middleware' => ['api', 'response.json'],
    ],
    function () {
        Route::post('/register', [RegisterController::class, 'register']);

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
