<?php

use App\Http\Controllers\Web\ConfigurateController;
use Illuminate\Support\Facades\Route;

Route::controller(ConfigurateController::class)
    ->prefix('/configurate')
    ->name('configurate.')
    ->middleware(['local-network', 'role:root'])
    ->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/login', 'login')->name('login');
            Route::post('/login', 'loginPost')->name('login.post');
        });

        Route::middleware('auth')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::put('/update', 'update')->name('update');
        });
    });
