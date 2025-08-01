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

Route::get('/test', function(){
    $test = App\Models\Glossary\Law::first();
    $relation = 'payments';

    dd([
        'record' => $test,
        'sql' => $test->$relation()->toSql(),
        'bindings' => $test->$relation()->getBindings(),
        'result' => $test->$relation
    ]);
});
