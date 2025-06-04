<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Law\StoreRequest;
use App\Http\Requests\Glossary\Law\UpdateRequest;
use App\Models\Glossary\Law;
use Inertia\Inertia;

class LawController extends Controller
{
    public function index()
    {
        $laws = Law::paginate(50)->toResourceCollection();

        return Inertia::render('glossary/laws/index', compact('laws'));
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
