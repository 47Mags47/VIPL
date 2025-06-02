<?php

namespace App\Http\Controllers\Web\Main\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreSessionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;

class AuthSessionController extends Controller
{
    public function create()
    {
        return Inertia::render('auth/login');
    }

    public function store(StoreSessionRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();
            // return response(['redirect' => route('dev.route-list')], 200);
            return to_route('dev.route-list');
        }

        // return 

        throw ValidationException::withMessages([
            'form' => __('auth.failed'),
        ]);
    }

    public function delete(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('session.create');
    }
}
