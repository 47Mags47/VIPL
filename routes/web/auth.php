<?php

use App\Http\Controllers\Web\Main\Auth\AuthSessionController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthSessionController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginPost')->name('login.post');

        Route::get('/forgot-password', 'passwordRequest')->name('password.request');
        Route::post('/forgot-password', 'passwordEmail')->name('password.email');
        Route::get('/reset-password/{token}', 'passwordReset')->name('password.reset');
        Route::post('/reset-password', 'passwordUpdate')->name('password.update');

    });
    Route::middleware('auth')->group(function () {
        Route::post('/logout', 'logout')->name('logout');

        Route::get('/change-edit', 'passwordEdit')->name('password.edit');
        Route::post('/change-password', 'passwordChangePost')->name('password.change');
    });
});
