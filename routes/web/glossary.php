<?php

use App\Http\Controllers\Web\Glossary\BankController;
use App\Http\Controllers\Web\Glossary\DivisionController;
use App\Http\Controllers\Web\Glossary\LawController;
use App\Http\Controllers\Web\Glossary\PaymentController;
use App\Http\Controllers\Web\Glossary\SourceController;
use App\Http\Controllers\Web\Glossary\ValidatorColumnController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'permission:edit_glossary'])->prefix('/glossary')->name('glossary.')->group(function () {
    Route::resource('/banks', BankController::class)->except(['show']);
    Route::resource('/divisions', DivisionController::class)->except(['show']);
    Route::resource('/laws', LawController::class)->except(['show']);
    Route::resource('/payments', PaymentController::class)->except(['show']);
    Route::resource('/sources', SourceController::class)->except(['show']);

    Route::controller(ValidatorColumnController::class)->prefix('/validator')->name('validator.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{column}/edit', 'edit')->name('edit');
        Route::put('/{column}', 'update')->name('update');
    });
});
