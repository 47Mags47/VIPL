<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('payments.events.index');
})->name('home');

Route::group([], [
    base_path('routes/web/configurate.php'),

    base_path('routes/web/main.php'),
    base_path('routes/web/auth.php'),
    base_path('routes/web/glossary.php'),
    base_path('routes/web/payment.php'),
]);

if (env('APP_ENV') === 'local')
    Route::group([], [
        base_path('routes/dev.php'),
    ]);
