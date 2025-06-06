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

    public function store(StoreRequest $request)
    {
        Division::create($request->only(['code', 'name']));

        return redirect()->route('glossary.divisions.index')->with('message', 'Запись успешно создана');
    }

    public function update(UpdateRequest $request, Division $division)
    {
        $division->update($request->only(['code', 'name']));

        return redirect()->route('glossary.divisions.index')->with('message', 'Запись успешно обновлена');
    }

    public function destroy(Division $division)
    {
        $division->delete();

        return redirect()->route('glossary.divisions.index')->with('message', 'Запись удалена');
    }
}
