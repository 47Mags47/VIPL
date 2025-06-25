<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\Payment\GenerateFromBanks;
use App\Models\Payment\Raport;
use App\Models\Payment\Event;
use App\Models\Payment\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RaportController extends Controller
{
    public function index(Package $package)
    {
        $raports = $package->raports()->paginate(50)->toResourceCollection();

        return Inertia::render('payment/raports/index', compact('raports'));
    }

    public function store(Request $request)
    {
        $event = Event::whereKey($request->event)->first;

        GenerateFromBanks::dispatch($event, user());

        return back()->with('message', 'Запущено формирование файлов в банк');
    }

    public function show(Raport $raport)
    {
        Storage::disk($raport->disk)->download($raport->localPath());

        return back();
    }

    public function destroy(Raport $raport) {
        $raport->delete();

        return back()->with('message', 'Отчет удален');
    }
}
