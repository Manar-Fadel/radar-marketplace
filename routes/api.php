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
Route::get('/brands', [BrandController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {

    // ✅ Orders
    Route::apiResource('orders', OrderController::class);
    Route::post('/orders/{order}/accept-offer', [OrderController::class, 'acceptOffer']);

    // ✅ Offers
    Route::post('/offers', [OfferController::class, 'store']);
    Route::post('/offers/{offer}/cancel', [OfferController::class, 'cancel']);

    // ✅ Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markRead']);


    /***********************     ADMIN          ***************************/
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::post('/brands', [BrandController::class, 'store']);
        Route::post('/brands/{id}', [BrandController::class, 'update']);
        Route::delete('/brands/{id}', [BrandController::class, 'destroy']);

        Route::apiResource('users', AdminUserController::class);
        Route::apiResource('orders', AdminOrderController::class);
        Route::apiResource('offers', AdminOfferController::class);
        Route::post('/offers/dealer/{id}', [AdminOfferController::class, 'dealerOffers']);

        Route::apiResource('brands', AdminBrandController::class);
        Route::get('/statistics', [AdminStatisticsController::class, 'index']);
    });

});


// ✅ Statistics
Route::get('/statistics', [StatisticsController::class, 'index']);
