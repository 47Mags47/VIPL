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
            'current_month_string' => $start_month->translatedFormat('F Y'),
            'current_month' => $month,
            'current_year' => $year,
            'previus_month' => $start_month->addMonth(-1)->month,
            'previus_year' => $start_month->addMonth(-1)->year,
            'next_month' => $start_month->addMonth(1)->month,
            'next_year' => $start_month->addMonth(1)->year,
        ];

        return Inertia::render('payment/events/index', compact('weeks', 'info'));
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

            return redirect()->route('payments.packages.show', compact('package'));
        }

        if (user()->isAdmin()) {
            $packages = $event->packages()->paginate(50)->toResourceCollection();

            return redirect()->route('payments.packages.index', compact('packages'));
        }

        return abort(403);
    }
}
