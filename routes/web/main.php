<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Main\UserController;
use App\Http\Controllers\Web\Main\DashboardController;

Route::middleware('auth')->prefix('/main')->name('main.')->group(function () {
    Route::middleware('permission:create_users')->group(function () {
        Route::resource('/users', UserController::class)->except(['show'])->withTrashed();
        Route::prefix('/users/{user}')->name('users.')->controller(UserController::class)->group(function () {
            Route::post('/send-invition', 'invitionSend')->name('invition.send');
        });
    });

    Route::prefix('/users/{user}')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('/accept-invition', 'invitionAccept')->name('invition.accept');
    });

    Route::prefix('/dashboard')->name('dashboard.')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });
});
