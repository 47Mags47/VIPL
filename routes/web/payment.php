<?php

use App\Http\Controllers\Web\Payment\BankFileController;
use App\Http\Controllers\Web\Payment\EventController;
use App\Http\Controllers\Web\Payment\FileController;
use App\Http\Controllers\Web\Payment\PackageController;
use App\Http\Controllers\Web\Payment\RaportController;
use App\Http\Controllers\Web\Payment\RecipientController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/payments')->name('payments.')->group(function () {
    Route::apiResource('events', EventController::class)->only([
        'index',
        'show'
    ]);

    Route::apiResource('event.packages', PackageController::class)->only([
        'index',
        'show'
    ]);

    Route::get('/package/{packages}/files/check', [FileController::class, 'check'])->name('package.files.check');
    Route::apiResource('package.files', FileController::class)->only([
        'index',
        'store',
        'show',
        'update',
        'destroy'
    ]);

    Route::apiResource('package.raports', RaportController::class)->only([
        'index',
        'store',
        'show',
        'destroy',
    ]);

    Route::apiResource('package.bank-files', BankFileController::class)->only([
        'index',
        'show',
        'destroy',
    ]);

    Route::apiResource('file.recipients', RecipientController::class)->only([
        'index',
        'update',
        'destroy'
    ]);

});
