<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\BankFile;
use App\Models\Payment\Package;
use Inertia\Inertia;

class BankFileController extends Controller
{
    public function index(Package $package)
    {
        $files = $package->bankFiles()->paginate(50)->toResourceCollection();

        return Inertia::render('payment/bankFile/index', compact('files'));
    }

    public function show(BankFile $file)
    {
        // DEV добавить сборку архива

        return back();
    }

    public function destroy(BankFile $file)
    {
        $file->delete();

        return back()->with('message', 'Файл удален');
    }
}
