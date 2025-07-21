<?php

use App\Http\Controllers\Web\Payment\EventController;
use App\Http\Controllers\Web\Payment\FileController;
use App\Http\Controllers\Web\Payment\PackageController;
use App\Http\Controllers\Web\Payment\RecipientController;
use App\Http\Controllers\Web\Raports\Payment\BankFileController;
use App\Http\Controllers\Web\Raports\Payment\TotalController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/payments')->name('payments.')->group(function () {
    Route::prefix('/events')->name('events.')->controller(EventController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{event}', 'show')->name('show');
    });

    Route::name('packages.')->controller(PackageController::class)->group(function () {
        Route::get('/events/{event}/packages', 'index')->middleware('role:system_admin')->name('index');
        Route::get('/packages/{package}', 'show')->name('show');
        Route::delete('/packages/{package}', 'destroy')->middleware('role:system_admin')->name('destroy');
    });

    Route::name('files.')->controller(FileController::class)->group(function () {
        Route::get('/packages/{package}/files', 'index')->name('index');
        Route::get('/packages/{package}/files/create', 'create')->name('create');
        Route::post('/packages/{package}/files', 'store')->name('store');
        Route::delete('packages/{package}/files/{file}', 'destroy')->name('destroy');
        Route::get('/files/{file}/show', 'show')->name('show');
    });

    Route::name('recipients.')->controller(RecipientController::class)->group(function () {
        Route::get('/files/{file}/recipients', 'index')->name('index');
    });

    Route::name('raports.')->controller(TotalController::class)->group(function () {
        Route::get('/events/{event}/raports', 'index')->name('index');
        Route::post('/events/{event}/raports', 'store')->name('store');

        Route::get('/raports/{raport}/download', 'download')->name('download');
        Route::put('/raports/{raport}/update', 'update')->name('update');
    })->middleware(['permission:create_payment_raports']);

    Route::name('bank-files.')->controller(BankFileController::class)->group(function () {
        Route::get('/raports/{raport}/bank-files/download', 'download')->name('download');
    });
});
