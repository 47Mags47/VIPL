<?php

use App\Http\Controllers\Web\Main\Auth\AuthSessionController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthSessionController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'create')->name('session.create');
        Route::post('session/store', 'store')->name('session.store');

        Route::get('/email/verify/{id}/{hash}', 'EmailVerify')->name('verification.verify');
        Route::post('/email-verify-send', 'EmailVerifySend')->name('verification.email-verify-send');
    });
    Route::middleware('auth')->group(function () {
        Route::post('/logout', 'delete')->name('session.destroy');
    });
});
