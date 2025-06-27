<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configurate\LoginPostRequset;
use App\Http\Requests\Configurate\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ConfigurateController extends Controller
{
    public function login()
    {
        return Inertia::render('configurate/Login');
    }

    public function loginPost(LoginPostRequset $request)
    {
        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password,
        ])) {
            return redirect()->route('configurate.index');
        }

        return back()->withErrors([
            'form' => 'Неверный логин или пароль',
        ]);
    }

    public function index()
    {
        $config = config('root');

        return Inertia::render('configurate/Index', compact('config'));
    }

    public function update(UpdateRequest $request){
        dd($request->all());
    }
}
