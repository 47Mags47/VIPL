<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\Payment\GenerateFromBanks;
use App\Models\Payment\Event;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    public function store(Request $request){
        $event = Event::whereKey($request->event)->first;

        GenerateFromBanks::dispatch($event, user());

        return back()->with('message', 'Запущено формирование файлов в банк');
    }
}
