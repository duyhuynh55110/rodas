<?php

use App\Modules\Api\Http\Controllers\AuthController;
use App\Modules\Api\Http\Controllers\CartController;
use App\Modules\Api\Http\Controllers\CategoryController;
use App\Modules\Api\Http\Controllers\CompositionController;
use App\Modules\Api\Http\Controllers\NotificationController;
use App\Modules\Api\Http\Controllers\FavoriteController;
use App\Modules\Api\Http\Controllers\ProductController;
use App\Modules\Api\Http\Controllers\UserController;
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
                Route::get('/profile', [UserController::class, 'profile']);

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
                        Route::get('/{id}', [ProductController::class, 'show']);
                        Route::get('/', [ProductController::class, 'index']);

                        // cart
                        Route::group(
                            [
                                'prefix' => 'cart',
                            ],
                            function () {
                                Route::get('/', [CartController::class, 'index']);
                                Route::post('/', [CartController::class, 'updateOrCreate']);
                                Route::delete('/', [CartController::class, 'delete']);
                            }
                        );

                        // favorite
                        Route::group(
                            [
                                'prefix' => 'favorite',
                            ],
                            function () {
                                Route::get('/', [FavoriteController::class, 'index']);
                                Route::post('/', [FavoriteController::class, 'create']);
                                Route::delete('/', [FavoriteController::class, 'delete']);
                            }
                        );
                    }
                );

                // notifications
                Route::group(
                    [
                        'prefix' => 'notifications',
                    ],
                    function () {
                        Route::get('/', [NotificationController::class, 'index']);
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
