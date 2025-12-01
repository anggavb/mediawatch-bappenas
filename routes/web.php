<?php

use Illuminate\Support\Facades\Route;

Route::get('/download/sample-import-media', App\Http\Controllers\Sample\ImportMediaController::class);

Route::get('/{path?}', function () {
    return view('index');
})->where('path', '.*')->name('homepage');
