<?php

namespace App\Http\Controllers\Web\Main\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordUpdateRequest;
use App\Http\Requests\Auth\StoreSessionRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthSessionController extends Controller
{
    public function login()
    {
        return Inertia::render('auth/login');
    }

    public function loginPost(StoreSessionRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']), $request->remember_me ?? false)) {
            $request->session()->regenerate();

            return user()->password_expired
                ? redirect()->route('password.reset')
                : redirect()->route('payments.events.index');
        }

        return back()->withErrors([
            'form' => 'Неверный логин или пароль',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function passwordReset()
    {
        return Inertia::render('auth/SetPassword');
    }

    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $user = user();
        $user->update($request->only('password'));

        event(new PasswordReset($user));

        $request->session()->regenerate();

        return redirect()->route('payments.events.index')->with('message', 'Пароль успешно изменен');
    }
}
