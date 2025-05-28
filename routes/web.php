<?php
use Illuminate\Support\Facades\Route;

Route::group([], [
    base_path('routes/web/dev.php'),

    base_path('routes/web/docs.php'),
    base_path('routes/web/auth.php'),
    base_path('routes/web/glossary.php'),
    base_path('routes/web/ftp.php'),
    base_path('routes/web/payment.php'),
    base_path('routes/web/validate.php'),
]);
