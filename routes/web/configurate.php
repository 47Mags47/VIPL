<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/configurate')->name('configurate.')->group(function () {
    Route::middleware('guest')->group(function () {

    });

    Route::middleware('auth')->group(function () {

    });
});
