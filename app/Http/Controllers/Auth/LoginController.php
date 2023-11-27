<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }



    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard('admin')->attempt($credential)) {

            return redirect()->route('home');
            
            // return redirect()->route('home', ['username' => Auth::guard('admin')->user()->username]);

            // return redirect()->route('home', ['username' => Auth::guard('admin')->user()->username]);

        } else {
             return redirect()->route('login')->with('error', 'Information is not correct');
        }
    }

    Public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }



}
