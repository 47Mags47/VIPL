<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\Package;
use Inertia\Inertia;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('created_at', 'desc')->paginate(50)->toResourceCollection();

        return Inertia::render('payment/packages/index', compact('packages'));
    }
}
