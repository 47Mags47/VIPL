<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Main\UserController;

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
});
