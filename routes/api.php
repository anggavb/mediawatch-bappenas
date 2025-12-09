<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MedmonController;
use App\Http\Controllers\Api\MediaGroupController;

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

    /** MEDIA */
    Route::get('media/show-unknown', [MediaController::class, 'showUnknown']);
    Route::post('media/import', [MediaController::class, 'import']);
    Route::apiResource('media', MediaController::class);

    /** MEDIA GROUPS */
    Route::apiResource('media-group', MediaGroupController::class);

    Route::post('medmon/import', [MedmonController::class, 'import']);
    Route::apiResource('medmon', MedmonController::class);
});


