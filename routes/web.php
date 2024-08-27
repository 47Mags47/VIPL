<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RosterController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

// Route::get('/appeal', [RosterController::class, 'index'])->name('export');
// Route::get('/appeal/export/csv', [RosterController::class, 'index'])->name('export.csv');
// Route::post('/appeal/export/csv', [RosterController::class, 'index']);
