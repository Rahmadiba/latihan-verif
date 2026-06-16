<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
         
            if (Auth::user()->role == 'konselor') {
                return redirect()->route('konselor.dashboard');
            }
            return redirect()->route('konsuli.dashboard');
        }

        return back()->withErrors(['login_error' => 'Email atau password salah!']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}