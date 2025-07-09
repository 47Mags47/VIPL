<?php

use App\Http\Controllers\Web\ConfigurateController;
use Illuminate\Support\Facades\Route;

Route::controller(ConfigurateController::class)->middleware(['auth', 'local-network', 'role:root'])->group(function () {
    Route::resource('config', ConfigurateController::class)->only(['index', 'edit', 'update']);
});
