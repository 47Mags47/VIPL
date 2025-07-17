<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\EventFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Event\StoreRequest;
use App\Http\Requests\Glossary\Event\UpdateRequest;
use App\Models\Glossary\EventStatus;
use App\Models\Glossary\Payment;
use App\Models\Payment\Event;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index(EventFilter $filter)
    {
        return Inertia::render('glossary/events/Index', [
            'events' => fn() => Event::filter($filter)->orderBy('date')->api(),
        ]);
    }

    public function create()
    {
        return Inertia::render('glossary/events/Create', [
            'payments' => Payment::api()
        ]);
    }

    public function store(StoreRequest $request)
    {
        foreach ($request->input('date') as $date) {
            Event::create([
                'date' => $date,
                'payment_id' => $request->input('payment_id'),
                'status_id' => EventStatus::byCode('active'),
            ]);
        }

        return redirect()->route('glossary.events.index')->with('message', 'Запись успешно добавлена');
    }

    public function edit(Event $event){
        if($event->date->isBefore(now()))
            return back()->with('warning', 'Невозможно изменить событие, которое уже произошло');

        return Inertia::render('glossary/events/Edit', [
            'event' => fn() => $event->toResource(),
            'payments' => Payment::api()
        ]);
    }

    public function update(UpdateRequest $request, Event $event){
        $event->update($request->only('date', 'payment_id'));

        return redirect()->route('glossary.events.index')->with('message', 'Запись успешно обновлена');
    }

    public function destroy(Event $event){
        $event->delete();

        return redirect()->route('glossary.events.index')->with('message', 'Запись удалена');
    }
}
