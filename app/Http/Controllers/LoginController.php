<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // resources/views/login.blade.php
    }

    public function login(Request $request)
    {
        // Validate inputs
        $credentials = $request->validate([
            'credential_email' => 'required|email', // ✅ FIXED
            'password' => 'required|string',
        ]);

            if (Auth::attempt([
                'credential_email' => $request->credential_email,
                'password' => $request->password,
            ], $request->filled('remember'))) {
                $request->session()->regenerate();

                $user = Auth::user();

                switch ($user->role_id) {
                    case '1': return redirect()->route('mem_dashboard')->with('success', 'Welcome Member!');
                    case '2': return redirect()->route('faci_dashboard')->with('success', 'Welcome Facilitator!');
                    case '3': return redirect()->route('admin_dashboard')->with('success', 'Welcome Admin!');
                    default:
                        Auth::logout();
                        return redirect('/login')->withErrors(['role' => 'Unauthorized role.']);
                }
            }

            return back()->withErrors([
                'credential_email' => 'Invalid credentials. Please try again.',
            ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
