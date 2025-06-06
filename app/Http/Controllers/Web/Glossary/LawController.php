<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\LawFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Law\StoreRequest;
use App\Http\Requests\Glossary\Law\UpdateRequest;
use App\Models\Glossary\Law;
use App\Models\Glossary\Source;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LawController extends Controller
{
    public function index(Request $request, LawFilter $filter)
    {
        $laws = Law::filter($filter)->paginate(50)->toResourceCollection();
        $sources = Source::all()->toResourceCollection();

        return Inertia::render('glossary/laws/index', compact('laws', 'sources'));
    }

    public function store(StoreRequest $request)
    {
        Law::create($request->only(['code', 'name', 'source_id']));

        return redirect()->route('glossary.laws.index')->with('message', 'Запись успешно создана');
    }

    public function update(UpdateRequest $request, Law $law)
    {
        $law->update($request->only(['code', 'name', 'source_id']));

        return redirect()->route('glossary.laws.index')->with('message', 'Запись успешно обновлена');
    }

    public function delete(Law $law)
    {
        $law->delete();

        return redirect()->route('glossary.laws.index')->with('message', 'Запись удалена');
    }
}
