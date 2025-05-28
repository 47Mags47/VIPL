<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\PaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Payment\StoreRequest;
use App\Http\Requests\Glossary\Payment\UpdateRequest;
use App\Models\Glossary\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function index(Request $request, PaymentFilter $filter)
    {
        $payments = Payment::filter($filter)->paginate(50)->toResourceCollection();

        return Inertia::render('glossary/payments/index', compact('payments'));
    }

    public function create()
    {
        return Inertia::render('glossary/payments/create');
    }

    public function store(StoreRequest $request)
    {
        Payment::create($request->only(['code', 'name']));

        return redirect()->route('glossary.payments.index')->with('message', 'Запись успешно создана');
    }

    public function print()
    {
        // DEV Печать справочника
    }

    public function edit(Payment $payment)
    {
        return Inertia::render('glossary/payments/edit', compact('payment'));
    }

    public function update(UpdateRequest $request, Payment $payment)
    {
        if ($request->code !== $payment->code)
            $request->validate(['code'   => 'unique:' . Payment::getTableName() . ',code']);

        if ($request->name !== $payment->name)
            $request->validate(['name'   => 'unique:' . Payment::getTableName() . ',name']);

        $payment->update($request->only(['code', 'name']));

        return redirect()->route('glossary.payments.index')->with('message', 'Запись успешно обновлена');
    }

    public function delete(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('glossary.payments.index')->with('message', 'Запись удалена');
    }
}
