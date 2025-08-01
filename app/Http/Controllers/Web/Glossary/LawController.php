<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\LawFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Law\StoreRequest;
use App\Http\Requests\Glossary\Law\UpdateRequest;
use App\Models\Glossary\Law;
use App\Models\Glossary\Source;
use Inertia\Inertia;

class LawController extends Controller
{
    public function index(LawFilter $filter)
    {
        return Inertia::render('glossary/laws/Index', [
            'laws' => fn() => Law::filter($filter)->api(),
        ]);
    }

    public function create()
    {
        return Inertia::render('glossary/laws/Create', [
            'sources' => fn() => Source::all()->toResourceCollection(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        Law::create($request->only(['code', 'name', 'source_id']));

        return redirect()->route('glossary.laws.index')->with('message', 'Запись успешно создана');
    }

    public function edit(Law $law)
    {
        return Inertia::render('glossary/laws/Edit', [
            'law' => fn() => $law->toResource(),
            'sources' => fn() => Source::all()->toResourceCollection(),
        ]);
    }

    public function update(UpdateRequest $request, Law $law)
    {
        $law->update($request->only(['code', 'name', 'source_id']));

        return redirect()->route('glossary.laws.index')->with('message', 'Запись успешно обновлена');
    }

    public function destroy(Law $law)
    {
        $law->delete();

        return back()->with('message', 'Запись удалена');
    }
}
