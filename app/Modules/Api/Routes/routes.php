<?php

use App\Modules\Api\Http\Controllers\AuthController;
use App\Modules\Api\Http\Controllers\CategoryController;
use App\Modules\Api\Http\Controllers\CompositionController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'domain' => env('APP_API_DOMAIN'),
        'as' => API_MODULE_AS,
        'middleware' => ['api', 'response.json'],
    ],
    function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // === Authentication
        Route::group(
            [
                'middleware' => ['auth:sanctum'],
            ],
            function () {
                // Categories
                Route::group(
                    [
                        'prefix' => 'categories',
                    ],
                    function () {
                        Route::get('/', [CategoryController::class, 'index']);
                    }
                );
            }
        );

        // === Without Authentication
        Route::group(
            [],
            function () {
                // Composition
                Route::group(
                    [
                        'prefix' => 'composition',
                    ],
                    function () {
                        Route::get('/home-page', [CompositionController::class, 'homePage']);
                    }
                );
            }
        );

        // Homepage
        Route::name('home')->get(
            '/',
            function () {
                return response()->json([
                    'message' => 'OK',
                    'status' => 200,
                ]);
            }
        )->middleware(['auth:sanctum']);
    }
);
