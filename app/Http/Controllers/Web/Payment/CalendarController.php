<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CalendarRequest;
use App\Jobs\Payment\GenerateEvents;
use App\Models\Payment\Event;
use Carbon\CarbonImmutable;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index(CalendarRequest $request)
    {
        GenerateEvents::dispatch();

        $month = (int) ($request->month ?? now()->month);
        $year = (int) ($request->year ?? now()->year);

        $start_month = CarbonImmutable::createFromDate($year, $month, 1);
        $end_month = $start_month->endOfMonth();

        $start_day = $start_month->startOfWeek();
        $end_day = $end_month->endOfWeek();

        $period = $start_day->toPeriod($end_day, '1 day');
        $weeks = collect($period->toArray())
            ->chunk(7)
            ->map(function ($week) use ($month) {
                return $week->map(function ($date) use ($month) {
                    return collect([$date->format('d.m') => [
                        'current_month' => (int) $month === $date->month,
                        'events' => Event::byDate($date)->toResourceCollection(),
                    ]]);
                })->collapse();
            });

        $info = [
            'current_month_string' => $start_month->translatedFormat('M Y'),
            'current_month' => $month,
            'current_year' => $year,
            'previus_month' => $start_month->addMonth(-1)->month,
            'previus_year' => $start_month->addMonth(-1)->year,
            'next_month' => $start_month->addMonth(1)->month,
            'next_year' => $start_month->addMonth(1)->year,
        ];

        return Inertia::render('payment/calendar/index', compact('weeks', 'info'));
    }
}
