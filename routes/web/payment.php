<?php


use App\Http\Controllers\Web\Payment\EventController;
use App\Http\Controllers\Web\Payment\FileController;
use App\Http\Controllers\Web\Payment\PackageController;
use App\Http\Controllers\Web\Payment\RaportController;
use App\Http\Controllers\Web\Payment\RecipientController;
use Illuminate\Support\Facades\Route;

Route::prefix('/payments')->name('payments.')->group(function () {
    Route::prefix('/events')->name('events.')->controller(EventController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/{event}/show', 'show')->name('show');
    });

    Route::prefix('/raports')->name('raports.')->controller(RaportController::class)->group(function () {
        Route::post('/store', 'store')->name('store');
    });

    Route::prefix('/packages')->controller(PackageController::class)->name('packages.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/{package}/show', 'show')->name('show');
    });

    Route::prefix('/package/{package}/files')->controller(FileController::class)->name('file.')->group(function () {
        Route::get('/table', 'table')->name('table');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::delete('/{file}/delete', 'delete')->name('delete');
    });

    Route::prefix('/file/{file}/recipients')->controller(RecipientController::class)->name('file.')->group(function () {
        Route::get('/index', 'index')->name('index');
    });
});
