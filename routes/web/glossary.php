<?php

use App\Http\Controllers\Web\Glossary\BankController;
use App\Http\Controllers\Web\Glossary\DivisionController;
use App\Http\Controllers\Web\Glossary\LawController;
use App\Http\Controllers\Web\Glossary\PaymentController;
use App\Http\Controllers\Web\Glossary\ValidatorColumnController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'permission:edit_glossary'])->prefix('/glossary')->name('glossary.')->group(function () {
    Route::resource('/banks', BankController::class);
    Route::resource('/divisions', DivisionController::class);

    Route::apiResource('/laws', LawController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);

    Route::apiResource('/payments', PaymentController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);

    Route::prefix('/importer/validator')->name('importer.validator.')->group(function () {
        Route::apiResource('columns', ValidatorColumnController::class)->only([
            'index',
            'update'
        ]);
    });
});
