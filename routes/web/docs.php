<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::middleware('auth')->prefix('/docs')->name('docs.')->group(function () {
    Route::get('/exporter', function () {
        return view('pages.markdown', ['content' => Storage::disk('docs')->get('exporter.md')]);
    })->name('exporter');
});
