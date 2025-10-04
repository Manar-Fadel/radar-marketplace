<?php

use App\Http\Controllers\Api\Web\AuthController;
use App\Http\Controllers\Api\Web\BrandController;
use App\Http\Controllers\Api\Web\NotificationController;
use App\Http\Controllers\Api\Web\OfferController;
use App\Http\Controllers\Api\Web\OrderController;
use App\Http\Controllers\Api\Web\StatisticsController;

use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Api\Admin\OfferController as  AdminOfferController;;
use App\Http\Controllers\Api\Admin\OrderController as  AdminOrderController;
use App\Http\Controllers\Api\Admin\StatisticsController as  AdminStatisticsController;
use App\Http\Controllers\Api\Admin\NotificationController as AdminNotificationController;

use Illuminate\Support\Facades\Route;

// ✅ Auth
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verify-email', [AuthController::class, 'verifyEmail']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

// ✅ Brands
Route::prefix('web')->group(function () {
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/save-order', [OrderController::class, 'saveOrder']);

});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/orders/{order}/accept-offer', [OrderController::class, 'acceptOffer']);

    // ✅ Offers
    Route::post('/offers', [OfferController::class, 'store']);
    Route::post('/offers/{offer}/cancel', [OfferController::class, 'cancel']);

    // ✅ Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markRead']);


    /***********************     ADMIN          ***************************/
    Route::prefix('admin')->group(function () {
        Route::post('/brands', [BrandController::class, 'store']);
        Route::post('/brands/{id}', [BrandController::class, 'update']);
        Route::delete('/brands/{id}', [BrandController::class, 'destroy']);

        Route::apiResource('users', AdminUserController::class);

        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('index');
            Route::post('/update/{id}', [AdminOrderController::class, 'update'])->name('update');
            Route::post('/change-status/{id}', [AdminOrderController::class, 'changeStatus'])->name('changeStatus');
            Route::get('/delete/{id}', [AdminOrderController::class, 'delete'])->name('delete');
            Route::get('/delete-image/{id}', [AdminOrderController::class, 'deleteImage'])->name('deleteImage');
            Route::get('/images/{id}', [AdminOrderController::class, 'orderImages'])->name('orderImages');
            Route::get('/offers/{id}', [AdminOrderController::class, 'offers'])->name('offers');
        });

        Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
            Route::get('/', [AdminOfferController::class, 'index'])->name('index');
            Route::get('/delete/{id}', [AdminOfferController::class, 'delete'])->name('delete');
            Route::post('/update/{id}', [AdminOfferController::class, 'update'])->name('update');
        });


        Route::apiResource('brands', AdminBrandController::class);
        Route::get('/statistics', [AdminStatisticsController::class, 'index']);
    });

});


// ✅ Statistics
Route::get('/statistics', [StatisticsController::class, 'index']);
