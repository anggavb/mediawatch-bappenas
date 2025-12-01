<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\AuthController;

// Public authentication routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware(['throttle:5,1']); // 5 attempts per minute
});

// Protected authentication routes
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'me']);
    });

    Route::post('media/import', [MediaController::class, 'import']);
    Route::apiResource('media', MediaController::class);
});
