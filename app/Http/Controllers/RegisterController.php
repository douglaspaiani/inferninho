<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function RegisterPage(){
        return view('app.register');
    }

    public function Register(Request $request){
        $data = $request->all();
        $user = new User();
        try {

            $user->RegisterNewUser($data);

            $credentials = [
                'email' => $data['email'],
                'password' => $data['password'],
            ];

            Auth::attempt($credentials);

            return redirect()->route('home');
            
        } catch (Exception $e){
            return redirect('register')->withErrors(['erro' => $e->getMessage()]);
        }
    }
}
