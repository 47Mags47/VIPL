<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\Payment\raports\GenerateJob;
use App\Models\Payment\Raport;
use App\Models\Payment\Event;
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
        GenerateJob::dispatch($event, user());

        return back()->with('message', 'Запущено формирование файлов в банк');
    }

    public function download(Raport $raport)
    {
        return $raport->download();
    }
}
