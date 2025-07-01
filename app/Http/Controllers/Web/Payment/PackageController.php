<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\Event;
use App\Models\Payment\Package;
use Inertia\Inertia;

class PackageController extends Controller
{
    public function index(Event $event)
    {
        $packages = Package::where('event_id', $event->id)->orderBy('created_at', 'desc')->paginate(50);

        return Inertia::render('payment/packages/index', [
            'event' => $event->toResource(),
            'packages' => $packages->toResourceCollection()
        ]);
    }

    public function show(Package $package)
    {
        return redirect()->route('payments.files.index', compact('package'));
    }
}
