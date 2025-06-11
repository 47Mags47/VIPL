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
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(CalendarRequest $request)
    {
        GenerateEvents::dispatch();

        $month = (int) ($request->month ?? now()->month);
        $year = (int) ($request->year ?? now()->year);

        $start_month = CarbonImmutable::createFromDate($year, $month, 1);
        $end_month = $start_month->endOfMonth();

        // $start_day = $start_month->startOfWeek();
        // $end_day = $end_month->endOfWeek();

        // $period = $start_day->toPeriod($end_day, '1 day');

        $events = Event::whereBetween('date', [$start_month, $end_month])
            ->get()
            ->map(function($event){
                return $event->toResource();
            })
            ->groupBy(function($event){
                return $event->date->format('Y-m-d');
            });
            

        // $weeks = collect($period->toArray())
        //     ->chunk(7)
        //     ->map(function ($week) use ($month) {
        //         return $week->map(function ($date) use ($month) {
        //             return collect([$date->format('d') => [
        //                 'current_month' => (int) $month === $date->month,
        //                 'events' => Event::byDate($date)->toResourceCollection(),
        //             ]]);
        //         })->collapse();
        //     });

        // $info = [
        //     'current_month_string' => $start_month->translatedFormat('F Y'),
        //     'current_month' => $month,
        //     'current_year' => $year,
        //     'previus_month' => $start_month->addMonth(-1)->month,
        //     'previus_year' => $start_month->addMonth(-1)->year,
        //     'next_month' => $start_month->addMonth(1)->month,
        //     'next_year' => $start_month->addMonth(1)->year,
        // ];

        return Inertia::render('payment/events/index', compact('events', 'month', 'year'));
    }

    public function show(Event $event)
    {
        if (user()->isUser()) {
            $package = Package::firstOrCreate([
                'event_id' => $event->id,
                'division_id' => user()->division->id,
            ], [
                'status_id' => PackageStatus::byCode('created')->id
            ]);

            return redirect()->route('payments.event.packages.show ', compact('event', 'package'));
        }

        if (user()->isAdmin()) {
            return redirect()->route('payment.event.packages.index', compact('event'));
        }

        return abort(403);
    }
}
