<?php

use App\Http\Controllers\Web\Main\DivisionUserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Main\UserController;
use App\Http\Controllers\Web\Main\DashboardController;

Route::middleware('auth')->prefix('/main')->name('main.')->group(function () {
    Route::middleware('permission:edit_division_admins')->prefix('/users')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::prefix('/{user}')->group(function () {
            Route::post('/restore', 'restore')->name('restore')->withTrashed();
            Route::post('/reset-password', 'resetPassword')->name('reset-password');
            Route::put('/update', 'update')->name('update');
            Route::put('/update', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
        });
    });

    Route::middleware('permission:edit_users')->prefix('divisions/{division}/users')->name('division.users.')->controller(DivisionUserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::prefix('/dashboard')->name('dashboard.')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });
});
