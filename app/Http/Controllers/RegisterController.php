<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'brgyCert'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'birthCert'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'gradeReport'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'idPicture'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::transaction(function () use ($validated, $request) {
            // 1. Create the user
            $user = User::create([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'last_name' => $validated['last_name'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'contact_number' => $validated['contact_number'],
                'email' => $validated['email'],
                'password' => null, // No password yet
                'role_id' => 1, // Default role
            ]);

            // 2. Save address
            $user->address()->create([
                'street_address' => $validated['street_address'],
                'barangay' => $validated['barangay'],
                'city_municipality' => $validated['city_municipality'],
                'province' => $validated['province'],
                'zip_code' => $validated['zip_code'],
            ]);

            // 3. Save documents (handle file uploads)
            $user->documents()->create([
                'brgyCert'    => $request->hasFile('brgyCert') ? $request->file('brgyCert')->store('uploads', 'public') : null,
                'birthCert'   => $request->hasFile('birthCert') ? $request->file('birthCert')->store('uploads', 'public') : null,
                'gradeReport' => $request->hasFile('gradeReport') ? $request->file('gradeReport')->store('uploads', 'public') : null,
                'idPicture'   => $request->hasFile('idPicture') ? $request->file('idPicture')->store('uploads', 'public') : null,
            ]);
        });

        return redirect()->route('welcome')->with('success', 'Registration successful!');
    }
}
