<?php

use App\Modules\Api\Http\Controllers\AuthController;
use App\Modules\Api\Http\Controllers\CartController;
use App\Modules\Api\Http\Controllers\CategoryController;
use App\Modules\Api\Http\Controllers\CompositionController;
use App\Modules\Api\Http\Controllers\CountryController;
use App\Modules\Api\Http\Controllers\FavoriteController;
use App\Modules\Api\Http\Controllers\NotificationController;
use App\Modules\Api\Http\Controllers\OrderIssueController;
use App\Modules\Api\Http\Controllers\ProductController;
use App\Modules\Api\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'domain' => env('APP_API_DOMAIN'),
        'middleware' => ['api'],
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
                        Route::get('/{id}', [CategoryController::class, 'show']);
                        Route::get('/', [CategoryController::class, 'index']);
                    }
                );

                // products
                Route::group(
                    [
                        'prefix' => 'products',
                    ],
                    function () {
                        // cart
                        Route::group(
                            [
                                'prefix' => 'cart',
                            ],
                            function () {
                                Route::get('/', [CartController::class, 'index']);
                                Route::post('/', [CartController::class, 'updateOrCreate']);
                                Route::delete('/{id}', [CartController::class, 'delete']);
                            }
                        );

                        // favorite
                        Route::group(
                            [
                                'prefix' => 'favorite',
                            ],
                            function () {
                                Route::get('/', [FavoriteController::class, 'index']);
                                Route::post('/{id}', [FavoriteController::class, 'create']);
                                Route::delete('/{id}', [FavoriteController::class, 'delete']);
                            }
                        );

                        Route::get('/{id}', [ProductController::class, 'show']);
                        Route::get('/', [ProductController::class, 'index']);
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

                // composition
                Route::group(
                    [
                        'prefix' => 'composition',
                    ],
                    function () {
                        Route::get('/home-page', [CompositionController::class, 'homePage']);
                    }
                );

                // order issues
                Route::group(
                    [
                        'prefix' => 'order-issues',
                    ],
                    function () {
                        Route::post('/', [OrderIssueController::class, 'create']);
                    }
                );

                // countries
                Route::group(
                    [
                        'prefix' => 'countries',
                    ],
                    function () {
                        Route::get('/', [CountryController::class, 'index']);
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
