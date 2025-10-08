<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function mem_dashboard()
    {
        $now = Carbon::now();

        // Ongoing activities
        $activeActivities = Activity::where('is_active', true)
            ->where('start_datetime', '<=', $now)
            ->where(function ($q) use ($now) {
                $q->where('end_datetime', '>=', $now)
                  ->orWhereNull('end_datetime');
            })
            ->get();

        // Future activities
        $upcomingActivities = Activity::where('is_active', true)
            ->where('start_datetime', '>', $now)
            ->get();

        // Past activities this member has joined
        $history = Auth::user()->activities()
            ->where('end_datetime', '<', $now)
            ->get();

        return view('mem_dashboard', compact('activeActivities', 'upcomingActivities', 'history'));
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::find(Auth::id());

        // Store new picture
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Delete old picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Update in DB
        $user->profile_picture = $path;
        $user->save();

        return back()->with('success', 'Profile picture updated successfully!');
    }

    public function uploadScholarshipRequirements(Request $request)
    {
        $request->validate([
            'brgyCert'    => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'birthCert'   => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'gradeReport' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'idPicture'   => 'nullable|file|mimes:jpg,png|max:2048',
            'cor'         => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'votersCert'  => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $user = User::find(Auth::id());

        foreach (['brgyCert', 'birthCert', 'gradeReport', 'idPicture', 'cor', 'votersCert'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('uploads/requirements', 'public');
                $user->$field = $path;

            }
        }

        $user->save();

        return back()->with('success', 'Requirements uploaded successfully!');
    }

public function updateProfile(Request $request)
{
    // Get the currently logged-in user
    $user = Auth::user();

    // Validate the inputs (optional but recommended)
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'contact_number' => 'nullable|string|max:20',
        'street_address' => 'nullable|string|max:255',
        'barangay' => 'nullable|string|max:255',
        'city_municipality' => 'nullable|string|max:255',
        'province' => 'nullable|string|max:255',
        'zip_code' => 'nullable|string|max:10',
        'school' => 'nullable|string|max:255',
        'course' => 'nullable|string|max:255',
        'gradeLevel' => 'nullable|string|max:50',
        'skills' => 'nullable|string|max:255',
        'emergency_contact_no' => 'nullable|string|max:255',
    ]);

    // Update the user's info
    $user->update([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'contact_number' => $request->contact_number,
        'street_address' => $request->street_address,
        'barangay' => $request->barangay,
        'city_municipality' => $request->city_municipality,
        'province' => $request->province,
        'zip_code' => $request->zip_code,
        'school' => $request->school,
        'course' => $request->course,
        'gradeLevel' => $request->gradeLevel, // must match column name in DB
        'skills' => $request->skills,
        'emergency_contact_no' => $request->emergency_contact_no, // must match DB column name
    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Profile updated successfully!');
}
}