<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\PaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Payment\StoreRequest;
use App\Http\Requests\Glossary\Payment\UpdateRequest;
use App\Models\Glossary\Law;
use App\Models\Glossary\Payment;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function index(PaymentFilter $filter)
    {
        return Inertia::render('glossary/payments/Index', [
            'payments' => fn() => Payment::filter($filter)->api(),
        ]);
    }

    public function create()
    {
        return Inertia::render('glossary/payments/Create', [
            'laws' => fn() => Law::api(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        Payment::create($request->only(['code', 'name', 'krv', 'kbk', 'law_id']));

        return redirect()->route('glossary.payments.index')->with('message', 'Запись успешно создана');
    }

    public function edit(Payment $payment)
    {
        return Inertia::render('glossary/payments/Edit', [
            'payment' => fn() => $payment->toResource(),
            'laws' => fn() => Law::api(),
        ]);
    }

    public function update(UpdateRequest $request, Payment $payment)
    {
        $payment->update($request->only(['code', 'name', 'krv', 'kbk', 'law_id']));

        return redirect()->route('glossary.payments.index')->with('message', 'Запись успешно обновлена');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('glossary.payments.index')->with('message', 'Запись удалена');
    }
}
