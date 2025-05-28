<?php

use App\Http\Controllers\Web\Main\Auth\AuthSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->controller(AuthSessionController::class)->name('session.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'create')->middleware('guest')->name('create');
        Route::post('/store', 'store')->middleware('guest')->name('store');
    });
    Route::middleware('auth')->group(function () {
        Route::post('/delete', 'delete')->middleware('auth')->name('delete');
    });
});
