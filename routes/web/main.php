<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Main\UserController;

Route::middleware('auth')->prefix('/main')->name('main.')->group(function () {
    Route::apiResource('users', UserController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ]);
});

