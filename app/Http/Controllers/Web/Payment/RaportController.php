<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StoreRaportRequest;
use App\Jobs\Payment\GenerateFromBanks;
use App\Models\Main\User;
use App\Models\Payment\Event;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    public function store(StoreRaportRequest $request){
        $event = Event::whereKey($request->event)->first;

        GenerateFromBanks::dispatch($event, user());

        return response('задача запущена');
    }
}
