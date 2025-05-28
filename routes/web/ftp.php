<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\FtpController;

Route::middleware('auth')->prefix('/ftp/files')->name('ftp.files.')->controller(FtpController::class)->group(function () {
    Route::get('/modal', 'modal')->name('modal');
    Route::get('/table', 'table')->name('table');
});
