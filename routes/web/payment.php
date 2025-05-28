<?php


use App\Http\Controllers\Web\Payment\CalendarController;
use App\Http\Controllers\Web\Payment\FileController;
use App\Http\Controllers\Web\Payment\PackageController;
use App\Http\Controllers\Web\Payment\RaportController;
use App\Http\Controllers\Web\Payment\RecipientController;
use Illuminate\Support\Facades\Route;

// HACK Не забыть прикрутить проверку на администратора
// payment.package.index

Route::middleware('auth')->prefix('/payment')->name('payment.')->group(function () {
    Route::prefix('/calendar')->name('calendar.')->controller(CalendarController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
    });

    Route::prefix('/raports')->name('raports.')->controller(RaportController::class)->group(function () {
        Route::post('/store', 'store')->name('store');
    });

    Route::prefix('/packages')->group(function () {
        Route::controller(PackageController::class)->name('package.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/edit', 'edit')->name('edit');

            Route::put('/{package}/update', 'update')->name('update');
            Route::get('/{package}/show', 'show')->name('show');
            Route::get('/{package}/mark', 'mark')->name('mark');
        });
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
