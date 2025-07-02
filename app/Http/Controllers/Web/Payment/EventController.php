<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CalendarRequest;
use App\Jobs\Payment\GenerateEvents;
use App\Models\Glossary\PackageStatus;
use App\Models\Payment\Event;
use App\Models\Payment\Package;
use Carbon\CarbonImmutable;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index(CalendarRequest $request)
    {
        GenerateEvents::dispatch();

        $month = (int) ($request->month ?? now()->month);
        $year = (int) ($request->year ?? now()->year);

        $start_month = CarbonImmutable::createFromDate($year, $month, 1)->startOfDay();
        $end_month = $start_month->endOfMonth();

        $events = Event::whereBetween('date', [$start_month, $end_month])
            ->get()
            ->map(function ($event) {
                return $event->toResource();
            })
            ->groupBy(function ($event) {
                return $event->date->format('Y-m-d');
            });

        return Inertia::render('payment/events/index', compact('events', 'month', 'year'));
    }

    public function show(Event $event)
    {
        if (user()->hasPermission('upload_payment_raport'))
            return redirect()->route('payments.packages.index', compact('event'));
        else {
            $package = Package::firstOrCreate([
                'event_id' => $event->id,
                'division_id' => user()->division->id,
            ], [
                'status_id' => PackageStatus::byCode('created')->id
            ]);

            return redirect()->route('payments.packages.show', compact('package'));
        }
    }
}
