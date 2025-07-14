<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CalendarRequest;
use App\Models\Glossary\PackageStatus;
use App\Models\Glossary\Payment;
use App\Models\Payment\Event;
use App\Models\Payment\Package;
use Carbon\CarbonImmutable;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index(CalendarRequest $request)
    {
        $month = (int) ($request->input('month') ?? now()->month);
        $year = (int) ($request->input('year') ?? now()->year);

        $start_month = CarbonImmutable::createFromDate($year, $month, 1)->startOfDay();
        $end_month = $start_month->endOfMonth();

        Payment::createEventsToPeriod($start_month, $end_month);

        return Inertia::render('payment/events/index', [
            'events' => fn() => Event::compactToPeriod($start_month, $end_month),
            'month' => fn() => $month,
            'year' => fn() => $year,
        ]);
    }

    public function show(Event $event)
    {
        if (user()->hasPermission('create_payment_raports'))
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
