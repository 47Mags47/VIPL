<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\File;
use Inertia\Inertia;

class RecipientController extends Controller
{
    public function index(File $file){
        $recipients = $file->recipients()->paginate(50)->toResourceCollection();

        return Inertia::render('payment/recipients/index', compact('recipients'));
    }
}
