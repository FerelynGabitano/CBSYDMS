<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }   

   public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Log::info('Login attempt with credentials: ', $credentials);

        if (Auth::attempt($credentials)) {
            Log::info('Login successful for: ' . $request->email);
            Log::info('Authenticated User: ', ['user' => Auth::user()]);
            return redirect()->route('mem_dashboard');
        }

        Log::info('Login failed for: ' . $request->email . '. User found: ' . (Auth::user() ? 'Yes' : 'No'));
        return redirect()->to('/login')->with('error', 'Invalid credentials');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function mem_dashboard()
    {
        return view('mem_dashboard'); // Ensure 'mem_dashboard' blade file exists in resources/views
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
