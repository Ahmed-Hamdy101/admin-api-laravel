<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth Routes (Public)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected Routes
Route::middleware('auth:api')->group(function () {

    // User Profile
    Route::prefix('user')->group(function () {
        Route::get('user', [UserController::class, 'user']);
        Route::put('users/info', [UserController::class, 'updateInfo']);
        Route::put('users/password', [UserController::class, 'updatePassword']);
    });

    // Admin Management
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);

    // Product Management
    Route::apiResource('products', ProductController::class);
    Route::apiResource('orders', OrderController::class)->only(['index','show']);
    Route::post('uploads', [ImageController::class, 'upload']);
});
