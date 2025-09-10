<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // Show the registration form
    public function create()
    {
        return view('register'); 
    }

    public function store(Request $request)
    {
        // validate input
        $validated = $request->validate([
            'first_name'        => 'required|string|max:50',
            'middle_name'       => 'nullable|string|max:50',   
            'last_name'         => 'required|string|max:50',
            'date_of_birth'     => 'required|date',
            'gender'            => 'required|in:Male,Female,Other',
            'contact_number'    => 'required|string|max:20',
            'email'             => 'required|email|unique:users,email',
            'street_address'    => 'required|string|max:255',
            'barangay'          => 'required|string|max:100',
            'city_municipality' => 'required|string|max:100',
            'province'          => 'required|string|max:100',
            'zip_code'          => 'required|string|max:20',
            'profile_picture'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // no password validation here
        ]);

        // handle file upload (optional)
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('photos', 'public');
        }

        // password is optional; admin can set it later
        $validated['password'] = null;

        // assign default role (adjust as needed)
        $validated['role_id'] = 1;  

        // save user
        User::create($validated);

        return redirect()->back()->with('success', 'Registration successful!');
    }
}
