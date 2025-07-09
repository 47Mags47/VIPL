<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configurate\LoginPostRequset;
use App\Http\Requests\Configurate\UpdateRequest;
use App\Models\Sys\Config;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ConfigurateController extends Controller
{
    public function index()
    {
        return Inertia::render('configurate/Index', [
            'config' => Config::api(),
        ]);
    }

    public function edit(Config $config)
    {
        return Inertia::render('configurate/Edit', [
            'config' => $config->toResource(),
        ]);
    }

    public function update(UpdateRequest $request, Config $config)
    {
        $config->update([
            'value'        => $request->input('value'),
        ]);

        return redirect()->route('config.index')->with('message', 'Запись успешно обновлена');
    }
}
