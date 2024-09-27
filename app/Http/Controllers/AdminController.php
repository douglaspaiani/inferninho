<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function Login(){
        return view('admin.login');
    }

    public function LoginPost(Request $request){
        $credentials = $request->only('user', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function Dashboard(){
        return view('admin.dashboard');
    }
}
