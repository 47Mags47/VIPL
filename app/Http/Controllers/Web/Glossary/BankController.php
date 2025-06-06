<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\BankFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Bank\StoreRequest;
use App\Http\Requests\Glossary\Bank\UpdateRequest;
use App\Models\Glossary\Bank;
use App\Models\Glossary\BankExporter;
use App\Models\Glossary\Contract;
use App\Models\Glossary\ContractSide;
use App\Models\Glossary\ContractSideType;
use Inertia\Inertia;

class BankController extends Controller
{
    public function index(Request $request, BankFilter $filter)
    {
        $banks = Bank::filter($filter)->paginate(50)->toResourceCollection();
        $exporters = BankExporter::paginate(50)->toResourceCollection();
        $division_sides = ContractSide::where('type_id', ContractSideType::byCode('division')->id)->paginate(50)->toResourceCollection();

        return Inertia::render('glossary/banks/index', compact('banks', 'exporters', 'division_sides'));
    }

    public function store(StoreRequest $request)
    {
        $bank_side = ContractSide::create([
            'name'    => $request->input('bank_side.name'),
            'INN'     => $request->input('bank_side.INN'),
            'account' => $request->input('bank_side.account'),
            'BIK'     => $request->input('bank_side.BIK'),
            'comment' => $request->input('bank_side.comment'),
            'type_id' => ContractSideType::byCode('bank')->id,
        ]);

        $contract = Contract::create([
            'number'            => $request->input('contract.number'),
            'signed_at'         => $request->input('contract.signed_at'),
            'division_side_id'  => $request->input('contract.division_side_id'),
            'bank_side_id'      => $bank_side->id,
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

    public function update(UpdateRequest $request, Bank $bank)
    {
        $bank->contract->bank->update([
            'name'    => $request->input('bank_side.name'),
            'INN'     => $request->input('bank_side.INN'),
            'account' => $request->input('bank_side.account'),
            'BIK'     => $request->input('bank_side.BIK'),
            'comment' => $request->input('bank_side.comment'),
        ]);

        $bank->contract->update([
            'number'            => $request->input('contract.number'),
            'signed_at'         => $request->input('contract.signed_at'),
            'division_side_id'  => $request->input('contract.division_side_id'),
        ]);

        $bank->update([
            'number_code'   => $request->input('bank.number_code'),
            'code'          => $request->input('bank.code'),
            'name'          => $request->input('bank.name'),
            'exporter_id'   => $request->input('bank.exporter_id'),
        ]);

        return redirect()->route('glossary.banks.index')->with('message', 'Запись успешно обновлена');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('glossary.banks.index')->with('message', 'Запись удалена');
    }
}
