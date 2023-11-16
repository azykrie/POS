<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard');
            } elseif (Auth::user()->role === 'cashier') {
                return redirect('/transaction');
            }
        }
        return redirect('/login')->with('error', 'Incorrect email or password.');;
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
