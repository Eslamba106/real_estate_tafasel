<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        // Logic for handling login
        if (auth()->attempt($request->only('username', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        } else {
            return redirect()->back()->withErrors(['login_error' => 'Invalid credentials'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return to_route('home');
    }
}
