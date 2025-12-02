<?php

use Illuminate\Support\Facades\Route;

Route::get('/download/sample-import-media', App\Http\Controllers\Sample\ImportMediaController::class);
Route::get('/medmon/generate-report', [App\Http\Controllers\Api\MedmonController::class, 'generateReport']);

Route::get('/{path?}', function () {
    return view('index');
})->where('path', '.*')->name('homepage');
