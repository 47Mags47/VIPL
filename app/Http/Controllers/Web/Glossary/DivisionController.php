<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\DivisionFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Division\StoreRequest;
use App\Http\Requests\Glossary\Division\UpdateRequest;
use App\Models\Glossary\Division;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DivisionController extends Controller
{
    public function index(Request $request, DivisionFilter $filter)
    {
        $divisions = Division::filter($filter)->paginate(50)->toResourceCollection();

        return Inertia::render('glossary/divisions/index', compact('divisions'));
    }

    public function create()
    {
        return Inertia::render('glossary/divisions/create');
    }

    public function store(StoreRequest $request)
    {
        Division::create($request->only(['code', 'name']));

        return redirect()->route('glossary.divisions.index')->with('message', 'Запись успешно создана');
    }

    public function print()
    {
        // DEV Печать справочника
    }

    public function edit(Division $division)
    {
        return Inertia::render('glossary/divisions/index', compact('division'));
    }

    public function update(UpdateRequest $request, Division $division)
    {
        if ($request->code !== $division->code)
            $request->validate(['code'   => 'unique:' . Division::getTableName() . ',code']);

        if ($request->name !== $division->name)
            $request->validate(['name'   => 'unique:' . Division::getTableName() . ',name']);

        $division->update($request->only(['code', 'name']));

        return redirect()->route('glossary.divisions.index')->with('message', 'Запись успешно обновлена');
    }

    public function delete(Division $division)
    {
        $division->delete();

        return redirect()->route('glossary.divisions.index')->with('message', 'Запись удалена');
    }
}
