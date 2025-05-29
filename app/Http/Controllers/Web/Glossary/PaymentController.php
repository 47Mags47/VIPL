<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\PaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Payment\StoreRequest;
use App\Http\Requests\Glossary\Payment\UpdateRequest;
use App\Models\Glossary\Payment;
use App\Models\Glossary\PaymentLaw;
use App\Models\Glossary\PaymentPeriodicity;
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
        $laws = PaymentLaw::paginate(50)->toResourceCollection();
        $peridicity = PaymentPeriodicity::all()->toResourceCollection();

        return Inertia::render('glossary/payments/create', compact('laws', 'peridicity'));
    }

    public function store(StoreRequest $request)
    {
        Payment::create($request->only(['code', 'name', 'krv', 'kbk', 'law_id', 'periodicity_id']));

        return redirect()->route('glossary.payments.index')->with('message', 'Запись успешно создана');
    }

    public function edit(Payment $payment)
    {
        $laws = PaymentLaw::paginate(50)->toResourceCollection();
        $peridicity = PaymentPeriodicity::all()->toResourceCollection();

        return Inertia::render('glossary/payments/edit', compact('payment', 'laws', 'peridicity'));
    }

    public function update(UpdateRequest $request, Payment $payment)
    {

        $payment->update($request->only(['code', 'name', 'krv', 'kbk', 'law_id', 'periodicity_id']));

        return redirect()->route('glossary.payments.index')->with('message', 'Запись успешно обновлена');
    }

    public function delete(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('glossary.payments.index')->with('message', 'Запись удалена');
    }
}
