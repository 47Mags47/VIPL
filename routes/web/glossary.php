<?php

use App\Http\Controllers\Web\Glossary\LawController;
use App\Http\Controllers\Web\Glossary\BankController;
use App\Http\Controllers\Web\Glossary\DivisionController;
use App\Http\Controllers\Web\Glossary\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/glossary')->name('glossary.')->group(function () {
    Route::get('/index', function () {
        return view('pages.glossary.index');
    })->name('index');

    Route::prefix('/laws')->controller(LawController::class)->name('laws.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::prefix('/{law}')->group(function () {
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::prefix('/banks')->controller(BankController::class)->name('banks.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::prefix('/{bank}')->group(function () {
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::prefix('/divisions')->controller(DivisionController::class)->name('divisions.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::prefix('/{division}')->group(function () {
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    Route::prefix('/payments')->controller(PaymentController::class)->name('payments.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::prefix('/{payment}')->group(function () {
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

});
