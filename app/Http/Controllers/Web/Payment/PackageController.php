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
        return Inertia::render('payment/packages/Index', [
            'event' => fn() => $event->toResource(),
            'packages' => fn() => $event->packages()->orderBy('created_at', 'desc')->api()
        ]);
    }

    public function show(Package $package)
    {
        return redirect()->route('payments.files.index', compact('package'));
    }

    public function destroy(Package $package){
        $event = $package->event;
        $package->delete();

        return redirect()->route('payments.packages.index', compact('event'))->with('message', 'Запись удалена');
    }
}
