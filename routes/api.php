<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\NotificationController;

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
        Route::post('/car-brands', [BrandController::class, 'store']);
        Route::post('/car-brands/{id}', [BrandController::class, 'update']);
        Route::delete('/car-brands/{id}', [BrandController::class, 'destroy']);
    });

});


// ✅ Statistics
//Route::get('/statistics', [StatisticsController::class, 'index']);
