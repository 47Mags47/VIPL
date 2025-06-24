<?php

use App\Http\Controllers\Web\Main\Auth\AuthSessionController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthSessionController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'create')->name('session.create');
        Route::post('session/store', 'store')->name('session.store');
    });
    Route::middleware('auth')->group(function () {
        Route::post('/logout', 'delete')->name('session.destroy');
    });
});
