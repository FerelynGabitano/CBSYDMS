<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        // Validate input
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
            'school'            => 'required|string|max:255',
            'gradeLevel'        => 'required|string|max:50',

            // File validations
            'brgyCert'     => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'birthCert'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'gradeReport'  => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'idPicture'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Store uploaded files in storage/app/public/uploads
        // and save the public-accessible path to the database
        $validated['brgyCert'] = 'storage/' . $request->file('brgyCert')->store('uploads', 'public');
        $validated['birthCert'] = 'storage/' . $request->file('birthCert')->store('uploads', 'public');
        $validated['gradeReport'] = 'storage/' . $request->file('gradeReport')->store('uploads', 'public');
        $validated['idPicture'] = 'storage/' . $request->file('idPicture')->store('uploads', 'public');

        // No password yet
        $validated['password'] = null;

        // Assign default role
        $validated['role_id'] = 1;

        // Save to DB
        User::create($validated);

        return redirect()->back()->with('success', 'Registration successful!');
    }
}
