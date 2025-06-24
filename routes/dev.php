<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/dev')->name('dev.')->group(function () {
    Route::get('/', function () {
        return inertia('dev/RouteList',[
            'package' => App\Models\Payment\Package::first()->id,
        ]);
    })->name('route-list');

    Route::get('/test-flash/message', function(){
        return back()->with([
            'message' => 'Действие было успешно выполнено',
            'error' => 'Действие было завершено с ошибкой'
        ]);
    })->name('test-flash');

    Route::get('/generate-raports', function () {
        $event = App\Models\Payment\Event::first();
        $job = new App\Jobs\Payment\GenerateFromBanks($event, App\Models\Main\User::whereKey(1)->first());
        $job->handle();
    })->name('generate-raports');

    Route::get('/read-file', function () {
        $file = App\Models\Payment\File::whereKey(1)->first();
        $job = new App\Jobs\File\ReadToDB($file);
        $job->handle();
    })->name('read-file');

    Route::get('/auth-admin', function () {
        $user = App\Models\Main\User::where('name', 'Администратор')->get()->first();
        Illuminate\Support\Facades\Auth::login($user);

        return redirect()->back();
    })->name('login-to-admin');

    Route::get('/auth-user', function () {
        $user = App\Models\Main\User::where('name', 'Пользователь')->get()->first();
        Illuminate\Support\Facades\Auth::login($user);

        return redirect()->back();
    })->name('login-to-user');

    Route::get('/auth-delete', function (Illuminate\Http\Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back();
    })->name('auth-delete');
});
