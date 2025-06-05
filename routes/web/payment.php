<?php


use App\Http\Controllers\Web\Payment\EventController;
use App\Http\Controllers\Web\Payment\FileController;
use App\Http\Controllers\Web\Payment\PackageController;
use App\Http\Controllers\Web\Payment\RaportController;
use App\Http\Controllers\Web\Payment\RecipientController;
use Illuminate\Support\Facades\Route;

Route::prefix('/payments')->name('payments.')->group(function () {
    Route::resource('events', EventController::class)->only([
        'index',
        'show'
    ]);
    Route::resource('event.packages', PackageController::class)->only([
        'index',
        'show'
    ]);
    Route::resource('package.files', FileController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ]);
    Route::resource('file.recipients', RecipientController::class)->only([
        'index'
    ]);

    Route::prefix('/raports')->name('raports.')->controller(RaportController::class)->group(function () {
        Route::post('/store', 'store')->name('store');
    });
});
