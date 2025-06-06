<?php

use App\Http\Controllers\Web\Glossary\BankController;
use App\Http\Controllers\Web\Glossary\DivisionController;
use App\Http\Controllers\Web\Glossary\LawController;
use App\Http\Controllers\Web\Glossary\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/glossary')->name('glossary.')->group(function () {
    Route::get('/index', function () {
        return view('pages.glossary.index');
    })->name('index');

    Route::apiResources([
        'banks' => BankController::class,
        'divisions' => DivisionController::class,
        'laws' => LawController::class,
        'payments' => PaymentController::class,
    ]);
});
