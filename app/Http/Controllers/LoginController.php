<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('pages.auth.login');
    }

    public function authenticate(Request $request){
        $validated = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('export');
        }else{
            return back()->withErrors(['login' => 'Неверный логин или пароль'])->withInput(['login']);
        }
    }
}
