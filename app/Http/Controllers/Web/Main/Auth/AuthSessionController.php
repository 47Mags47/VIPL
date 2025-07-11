<?php

namespace App\Http\Controllers\Web\Main\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\PasswordEmailRequest;
use App\Http\Requests\Auth\PasswordUpdateRequest;
use App\Http\Requests\Auth\StoreSessionRequest;
use App\Models\Main\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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
                return redirect()->route('password.edit')
                    ->with('message', 'Для продолжения необходимо сменить пароль');

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

    public function passwordRequest()
    {
        return Inertia::render('auth/ForgotPassword');
    }

    public function passwordEmail(PasswordEmailRequest $request)
    {
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::ResetLinkSent
            ? back()->with('message', __($status))
            : back()->withErrors(['email' => 'Ссылка для сброса отправлена на почту']);
    }

    public function passwordReset(Request $request, string $token)
    {
        return Inertia::render('auth/ResetPassword', [
            'token' => fn() => $token,
            'email' => fn() => $request->email,
        ]);
    }

    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('message', 'Пароль успешно изменен')
            : back()->withErrors(['form' => [__($status)]]);
    }

    public function passwordEdit()
    {
        return Inertia::render('auth/EditPassword', [
            'email' => fn() => user()->email,
        ]);
    }

    public function passwordChangePost(ChangePasswordRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            user()->forceFill([
                'password' => Hash::make($request->new_password)
            ])->setRememberToken(Str::random(60));

            event(new PasswordReset(user()));

            return redirect()->route('home')->with('message', 'Пароль успешно изменен');
        }

        return back()->withErrors(['form' => 'Неверный логин или пароль']);
    }
}
