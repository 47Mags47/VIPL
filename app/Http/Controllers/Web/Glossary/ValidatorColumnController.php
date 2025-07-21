<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Validator\UpdateRequest;
use App\Models\Glossary\ValidatorColumn;
use App\Models\Sys\Glossary\ValidatorColumnType;
use Inertia\Inertia;

class ValidatorColumnController extends Controller
{
    public function index()
    {
        return Inertia::render('glossary/validator/Index', [
            'columns' => fn() => ValidatorColumn::api(),
        ]);
    }

    public function edit(ValidatorColumn $column)
    {
        return Inertia::render('glossary/validator/Edit', [
            'column' => fn() => $column->toResource(),
            'types' => fn() => ValidatorColumnType::api(),
        ]);
    }

    public function update(UpdateRequest $request, ValidatorColumn $column)
    {
        $column->update($request->only(['file_pos', 'required', 'patterns']));

        return redirect()->route('glossary.validator.index')->with('message', 'Запись успешно обновлена');
    }
}
