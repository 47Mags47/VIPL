<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\Payment\GenerateFromBanks;
use App\Models\Payment\Raport;
use App\Models\Payment\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RaportController extends Controller
{
    public function index(Event $event)
    {
        $raports = $event->raports()->paginate(50);

        return Inertia::render('payment/raports/index', [
            'event' => $event->toResource(),
            'raports' => $raports->toResourceCollection()
        ]);

        return Inertia::render('payment/raports/index', compact('raports'));
    }

    public function store(Event $event)
    {
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
