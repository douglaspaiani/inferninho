<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function LoginPage(){
        return view('app.login');
    }

    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('app/home');
        }

        return redirect('login')->withErrors(['error' => 'Credenciais inválidas, tente novamente.']);
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
