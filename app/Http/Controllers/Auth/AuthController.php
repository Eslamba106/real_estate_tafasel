<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
         $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        // Logic for handling login
        if(auth()->attempt($request->only('username', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }else {
            return redirect()->back()->withErrors(['login_error' => 'Invalid credentials'])->withInput();
        }
    }
}
