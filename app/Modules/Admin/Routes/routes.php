<?php

use App\Modules\Admin\Http\Controllers\Auth\LoginController;
use App\Modules\Admin\Http\Controllers\Auth\LogoutController;
use App\Modules\Admin\Http\Controllers\BrandController;
use App\Modules\Admin\Http\Controllers\GiftBoxController;
use App\Modules\Admin\Http\Controllers\ProductController;
use App\Modules\Admin\Http\Controllers\StorageController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'domain' => env('APP_ADMIN_DOMAIN'),
        'as' => ADMIN_MODULE_AS,
        'middleware' => ['web'],
    ],
    function () {
        // Authentication
        Route::name('login')->get('/login', [LoginController::class, 'login']);
        Route::name('authenticate')->post('/authenticate', [LoginController::class, 'authenticate']);
        Route::name('logout')->get('/logout', [LogoutController::class, 'logout']);

        // Admin group
        Route::group(
            [
                'middleware' => 'auth',
            ],
            function () {
                // brands
                Route::group(
                    [
                        'prefix' => 'brands',
                        'as' => 'brands.',
                    ],
                    function () {
                        Route::name('index')->get('/', [BrandController::class, 'index']);
                        Route::name('create')->get('/create', [BrandController::class, 'create']);
                        Route::name('edit')->get('/{id}/edit', [BrandController::class, 'edit']);
                        Route::name('save')->post('/save', [BrandController::class, 'save']);
                    }
                );

                // products
                Route::group(
                    [
                        'prefix' => 'products',
                        'as' => 'products.',
                    ],
                    function () {
                        Route::name('index')->get('/', [ProductController::class, 'index']);
                        Route::name('create')->get('/create', [ProductController::class, 'create']);
                        Route::name('edit')->get('/{id}/edit', [ProductController::class, 'edit']);
                        Route::name('save')->post('/save', [ProductController::class, 'save']);
                    }
                );

                // gift-boxes
                Route::group(
                    [
                        'prefix' => 'gift-boxes',
                        'as' => 'gift-boxes.',
                    ],
                    function () {
                        Route::name('index')->get('/', [GiftBoxController::class, 'index']);
                        Route::name('create')->get('/create', [GiftBoxController::class, 'create']);
                        Route::name('edit')->get('/{id}/edit', [GiftBoxController::class, 'edit']);
                        Route::name('save')->post('/save', [GiftBoxController::class, 'save']);
                    }
                );

                // upload image to store
                Route::name('upload-to-storage')->post('/upload-to-storage', [StorageController::class, 'uploadMultipleImagesToStorage']);

                // homepage
                Route::name('home')->get(
                    '/',
                    function () {
                        return redirect(routeAdmin('brands.index'));
                    }
                );
            }
        );
    }
);

// PHP info
Route::get('/phpinfo', function () {
    return phpinfo();
});
