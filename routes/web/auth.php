<?php

use App\Http\Controllers\Web\Main\Auth\AuthSessionController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthSessionController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginPost')->name('login.post');
    });
    Route::middleware('auth')->group(function () {
        Route::post('/logout', 'logout')->name('logout');

        Route::get('/forgot-password', 'passwordReset')->name('password.reset');
        Route::post('/forgot-password', 'passwordUpdate')->name('password.update');
    });
});
