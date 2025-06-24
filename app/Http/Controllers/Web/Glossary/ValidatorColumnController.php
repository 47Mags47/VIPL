<?php

namespace App\Http\Controllers\Web\Glossary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Glossary\Validator\UpdateRequest;
use App\Models\Glossary\ValidatorColumn;
use Inertia\Inertia;

class ValidatorColumnController extends Controller
{
    public function index(){
        return Inertia::render('glossary/validator/index');
    }

    public function update(UpdateRequest $request, ValidatorColumn $column){
        $column->update($request->only(['file_pos', 'required', 'patterns']));
    }
}
