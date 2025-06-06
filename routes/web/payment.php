<?php


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
    Route::apiResource('package.files', FileController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ]);
    Route::apiResource('file.recipients', RecipientController::class)->only([
        'index'
    ]);

    Route::prefix('/raports')->name('raports.')->controller(RaportController::class)->group(function () {
        Route::post('/store', 'store')->name('store');
    });
});
