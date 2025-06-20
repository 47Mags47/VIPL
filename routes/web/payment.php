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

    Route::prefix('/package/{package}/files')->name('package.files.')->controller(FileController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/check', 'check')->name('check');
    });
    Route::prefix('/files/{file}')->name('files.')->controller(FileController::class)->group(function(){
        Route::get('/show', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/destroy', 'destroy')->name('destroy');
    });

    Route::apiResource('file.recipients', RecipientController::class)->only([
        'index',
        'update',
        'destroy'
    ]);

    Route::prefix('/raports')->name('raports.')->controller(RaportController::class)->group(function () {
        Route::get('/store', 'store')->name('store');
    });
});
