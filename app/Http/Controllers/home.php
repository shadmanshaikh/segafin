<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class home extends Controller
{
    //
    public function index()
    {
        $name = request('email');
        $password = request('password');
        // if(auth())
        return view('home', compact('name' , 'password'));
    }
    public function login()
    {
        $email = request('email');
        $password = request('password');

        $credentials = ['email' => $email, 'password' => $password];
        if(Auth::attempt($credentials)){
            return redirect('/dashboard');
        }
        return redirect('/')->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
