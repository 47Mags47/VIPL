<?php

use App\Http\Controllers\Web\Validate\AccountController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/validate')->name('validate.')->group(function () {

    Route::prefix('/accounts')->controller(AccountController::class)->name('accounts.')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    });

});
