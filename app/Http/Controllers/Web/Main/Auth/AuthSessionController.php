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
        return Inertia::render('auth/Login');
    }

    public function loginPost(StoreSessionRequest $request)
    {
        $login = (string) $request->login;
        $password = (string) $request->password;
        $remember = (bool) $request->remember_me ?? false;

        if (
            Auth::attempt(['email' => $login, 'password' => $password], $remember)
            or Auth::attempt(['login' => $login, 'password' => $password], $remember)
        ) {
            if (user()->password_expired)
                return redirect()->route('password.reset');

            if (user()->hasPermission('system_configuration'))
                return redirect()->route('config.index');

            return redirect()->route('payments.events.index');
        }

        return redirect()->route('login')->withErrors([
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
