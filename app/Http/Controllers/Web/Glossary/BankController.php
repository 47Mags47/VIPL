<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\BankFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Bank\StoreRequest;
use App\Http\Requests\Glossary\Bank\UpdateRequest;
use App\Models\Glossary\Bank;
use App\Models\Glossary\BankExporter;
use App\Models\Glossary\Contract;
use Inertia\Inertia;

class BankController extends Controller
{
    public function index(BankFilter $filter)
    {
        return Inertia::render('glossary/banks/Index', [
            'banks' => fn() => Bank::filter($filter)->api(),
        ]);
    }

    public function create()
    {
        return Inertia::render('glossary/banks/Create', [
            'exporters' => fn() => BankExporter::all()->toResourceCollection(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $contract = Contract::create([
            'number'        => $request->input('contract.number'),
            'signed_at'     => $request->input('contract.signed_at'),
        ]);

        Bank::create([
            'number_code'   => $request->input('bank.number_code'),
            'code'          => $request->input('bank.code'),
            'name'          => $request->input('bank.name'),
            'exporter_id'   => $request->input('bank.exporter_id'),
            'contract_id'   => $contract->id,
        ]);

        return redirect()->route('glossary.banks.index')->with('message', 'Запись успешно добавлена');
    }

    public function edit(Bank $bank)
    {
        return Inertia::render('glossary/banks/Edit', [
            'exporters' => fn() => BankExporter::all()->toResourceCollection(),
            'bank' => fn() => $bank->toResource()
        ]);
    }

    public function update(UpdateRequest $request, Bank $bank)
    {
        $contract = $bank->contract !== null
            ? $bank->contract->update([
                'number'        => $request->input('contract.number'),
                'signed_at'     => $request->input('contract.signed_at'),
            ])
            : Contract::create([
                'number'        => $request->input('contract.number'),
                'signed_at'     => $request->input('contract.signed_at'),
            ]);

        $bank->update([
            'number_code'   => $request->input('bank.number_code'),
            'code'          => $request->input('bank.code'),
            'name'          => $request->input('bank.name'),
            'exporter_id'   => $request->input('bank.exporter_id'),
            'contract_id'   => $bank->contract?->id ?? $contract->id,
        ]);

        return redirect()->route('glossary.banks.index')->with('message', 'Запись успешно обновлена');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('glossary.banks.index')->with('message', 'Запись удалена');
    }
}
