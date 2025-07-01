<?php

use App\Http\Controllers\Web\Payment\EventController;
use App\Http\Controllers\Web\Payment\FileController;
use App\Http\Controllers\Web\Payment\PackageController;
use App\Http\Controllers\Web\Payment\RaportController;
use App\Http\Controllers\Web\Payment\RecipientController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/payments')->name('payments.')->group(function () {
    Route::prefix('/events')->name('events.')->controller(EventController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{event}/show', 'show')->name('show');
    });

    Route::name('packages.')->controller(PackageController::class)->group(function () {
        Route::get('/events/{event}/packages', 'index')->name('index');
        Route::get('/packages/{package}/show', 'show')->name('show');
    });

    Route::name('files.')->controller(FileController::class)->group(function () {
        Route::get('/packages/{package}/files', 'index')->name('index');
        Route::post('/packages/{package}/files', 'store')->name('store');
        Route::post('/files/check', 'check')->name('check');
        Route::get('/files/{file}/show', 'show')->name('show');
    });

    Route::name('recipients.')->controller(RecipientController::class)->group(function () {
        Route::get('/files/{file}/recipients', 'index')->name('index');
        Route::put('/recipients/{recipient}/update', 'update')->name('update');
        Route::delete('/recipients/{recipient}/destroy', 'destroy')->name('destroy');
    });

    Route::name('raports.')->controller(RaportController::class)->group(function () {
        Route::get('/events/{event}/raports', 'index')->name('index');
        Route::post('/events/{event}/raports', 'store')->name('store');
        Route::get('/raports/{raport}/show', 'show')->name('show');
        Route::delete('/raports/{raport}/destroy', 'destroy')->name('destroy');
    });

});
