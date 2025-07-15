<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Filters\Glossary\SourceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Sources\StoreRequest;
use App\Http\Requests\Glossary\Sources\UpdateRequest;
use App\Models\Glossary\Source;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SourceController extends Controller
{
    public function index(SourceFilter $filter){
        return Inertia::render('glossary/sources/Index', [
            'sources' => fn() => Source::filter($filter)->api(),
        ]);
    }

    public function create(){
        return Inertia::render('glossary/sources/Create');
    }

    public function store(StoreRequest $request){
        Source::create($request->only('code', 'name'));

        return redirect()->route('glossary.sources.index')->with('message', 'Запись успешно добавлена');
    }

    public function edit(Source $source){
        return Inertia::render('glossary/sources/Edit', [
            'source' => fn() => $source->toResource()
        ]);
    }

    public function update(UpdateRequest $request, Source $source){
        $source->update($request->only('code', 'name'));

        return redirect()->route('glossary.sources.index')->with('message', 'Запись успешно обновлена');
    }

    public function destroy(Source $source){
        $source->delete();

        return redirect()->route('glossary.sources.index')->with('message', 'Запись удалена');
    }
}
