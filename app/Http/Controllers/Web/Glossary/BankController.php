<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\BankFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Bank\StoreRequest;
use App\Http\Requests\Glossary\Bank\UpdateRequest;
use App\Models\Glossary\Bank;
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
        return Inertia::render('glossary.banks.create');
    }

    public function store(StoreRequest $request)
    {
        Bank::create($request->only(['number_code', 'code', 'name']));

        return redirect()->route('glossary.bank.index')->with('message', 'Запись успешно создана');
    }

    public function print()
    {
        // DEV Печать справочника
    }

    public function edit(Bank $bank)
    {
        return Inertia::render('glossary.banks.create', ['bank' => $bank->toResource()]);
    }

    public function update(UpdateRequest $request, Bank $bank)
    {
        if ($request->number_code !== $bank->number_code)
            $request->validate(['number_code'   => 'unique:' . Bank::getTableName() . ',number_code']);

        if ($request->code !== $bank->code)
            $request->validate(['code'   => 'unique:' . Bank::getTableName() . ',code']);

        if ($request->name !== $bank->name)
            $request->validate(['name'   => 'unique:' . Bank::getTableName() . ',name']);

        $bank->update($request->only(['number_code', 'code', 'name']));

        return redirect()->route('glossary.bank.index')->with('message', 'Запись успешно обновлена');
    }

    public function delete(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('glossary.bank.index')->with('message', 'Запись удалена');
    }
}
