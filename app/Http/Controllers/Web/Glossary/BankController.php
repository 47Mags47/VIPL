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

        return Inertia::render('glossary/banks/index', compact('banks'));
    }

    public function create()
    {
        $exporters = BankExporter::paginate(50)->toResourceCollection();
        $division_sides = ContractSide::where('type_id', ContractSideType::byCode('division')->id)->paginate(50)->toResourceCollection();

        return Inertia::render('glossary/banks/create', compact('exporters', 'division_sides'));
    }

    public function store(StoreRequest $request)
    {
        $bank_side = ContractSide::create([
            'name'    => $request->get('bank_side.name'),
            'INN'     => $request->get('bank_side.INN'),
            'account' => $request->get('bank_side.account'),
            'BIK'     => $request->get('bank_side.BIK'),
            'comment' => $request->get('bank_side.comment'),
            'type_id' => ContractSideType::byCode('bank')->id,
        ]);

        $contract = Contract::create([
            'number'            => $request->get('contract.number'),
            'signed_at'         => $request->get('contract.signed_at'),
            'division_side_id'  => $request->get('contract.division_side_id'),
            'bank_side_id'      => $bank_side->id,
        ]);

        Bank::create([
            'number_code'   => $request->get('bank.number_code'),
            'code'          => $request->get('bank.code'),
            'name'          => $request->get('bank.name'),
            'exporter_id'   => $request->get('bank.exporter_id'),
            'contract_id'   => $contract->id,
        ]);

        return redirect()->route('glossary.bank.index')->with('message', 'Запись успешно создана');
    }

    public function edit(Bank $bank)
    {
        $exporters = BankExporter::paginate(50)->toResourceCollection();
        $division_sides = ContractSide::where('type_id', ContractSideType::byCode('division')->id)->paginate(50)->toResourceCollection();

        return Inertia::render('glossary/banks/edit', [
            'bank' => $bank->toResource(),
            'exporters' => $exporters,
            'division_sides' => $division_sides,
        ]);
    }

    public function update(UpdateRequest $request, Bank $bank)
    {

        $bank->contract->bank->update([
            'name'    => $request->get('bank_side.name'),
            'INN'     => $request->get('bank_side.INN'),
            'account' => $request->get('bank_side.account'),
            'BIK'     => $request->get('bank_side.BIK'),
            'comment' => $request->get('bank_side.comment'),
            'type_id' => ContractSideType::byCode('bank')->id,
        ]);

        $bank->contract->update([
            'number'            => $request->get('contract.number'),
            'signed_at'         => $request->get('contract.signed_at'),
            'division_side_id'  => $request->get('contract.division_side_id'),
        ]);

        $bank->update([
            'number_code'   => $request->get('bank.number_code'),
            'code'          => $request->get('bank.code'),
            'name'          => $request->get('bank.name'),
            'exporter_id'   => $request->get('bank.exporter_id'),
        ]);

        return redirect()->route('glossary.bank.index')->with('message', 'Запись успешно обновлена');
    }

    public function delete(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('glossary.bank.index')->with('message', 'Запись удалена');
    }
}
