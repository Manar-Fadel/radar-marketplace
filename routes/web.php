<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'logs', 'as' => 'logs.'], function () {
            Route::get('/', [IndexController::class, 'logs'])->name('index');
        });

        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/export', [OrderController::class, 'export'])->name('export');
        });

        Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
            Route::get('/', [OfferController::class, 'index'])->name('index');
            Route::get('/export', [OfferController::class, 'export'])->name('export');
        });

        Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::post('/store', [BrandController::class, 'store'])->name('store');
            Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('delete');
            Route::get('/delete-model/{id}', [BrandController::class, 'deleteModel'])->name('delete-model');
            Route::post('/store-model', [BrandController::class, 'storeModel'])->name('store-model');
        });

        Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/view/{id}', [UserController::class, 'view'])->name('view');
            Route::get('/export', [UserController::class, 'export'])->name('export');
        });
        Route::group(['prefix' => 'dealers', 'as' => 'dealers.'], function () {
            Route::get('/', [DealerController::class, 'index'])->name('index');
            Route::post('/store', [DealerController::class, 'store'])->name('store');
            Route::get('/view/{id}', [DealerController::class, 'view'])->name('view');
            Route::get('/activate/{id}', [DealerController::class, 'activate'])->name('activate');
            Route::get('/delete/{id}', [DealerController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', [SettingsController::class, 'index'])->name('index');
            Route::post('/update', [SettingsController::class, 'update'])->name('update');

            Route::get('/list', [SettingsController::class, 'list'])->name('list');
            Route::get('/delete/{id}', [SettingsController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::get('/delete/{id}', [NotificationController::class, 'delete'])->name('delete');
        });

    });

});
