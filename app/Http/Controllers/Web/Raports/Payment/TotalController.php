<?php

namespace App\Http\Controllers\Web\Raports\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\Payment\raports\GenerateJob;
use App\Models\Glossary\Event;
use App\Models\Main\Raports\Payment\Total;
use Inertia\Inertia;

class TotalController extends Controller
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

    public function download(Total $raport)
    {
        return $raport->download();
    }
}
