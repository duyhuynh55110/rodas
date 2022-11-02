<?php

use App\Modules\Api\Http\Controllers\AuthController;
use App\Modules\Api\Http\Controllers\CategoryController;
use App\Modules\Api\Http\Controllers\CompositionController;
use App\Modules\Api\Http\Controllers\ProductController;
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
                // categories
                Route::group(
                    [
                        'prefix' => 'categories',
                    ],
                    function () {
                        Route::get('/', [CategoryController::class, 'index']);
                    }
                );

                // products
                Route::group(
                    [
                        'prefix' => 'products',
                    ],
                    function () {
                        Route::get('/', [ProductController::class, 'index']);
                    }
                );
            }
        );

        // === Without Authentication
        Route::group(
            [],
            function () {
                // composition
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

        // test
        Route::get(
            '/',
            function () {
                return response()->json([
                    'message' => 'api ready',
                    'status' => 200,
                ]);
            }
        );
    }
);
