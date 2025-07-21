<?php

namespace App\Http\Controllers\Web\Payment;

use App\Filters\Payment\RecipientFilter;
use App\Http\Controllers\Controller;
use App\Models\Main\Payment\File;
use Inertia\Inertia;

class RecipientController extends Controller
{
    public function index(File $file, RecipientFilter $filter){
        return Inertia::render('payment/recipients/Index', [
            'recipients' => fn() => $file->recipients()->getQuery()->filter($filter)->paginate(50)->toResourceCollection(),
        ]);
    }
}
