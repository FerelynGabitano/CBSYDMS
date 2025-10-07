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
                $path = $request->file($field)->store('requirements', 'public');
                $user->$field = $path;
            }
        }

        $user->save();

        return back()->with('success', 'Requirements uploaded successfully!');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
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
        ]);

        $user->update($request->only([
            'first_name',
            'middle_name',
            'last_name',
            'date_of_birth',
            'gender',
            'contact_number',
            'email',
            'street_address',
            'barangay',
            'city_municipality',
            'province',
            'zip_code',
            'address',
            'barangay',
            'education',
            'course',
            'skills',
            'emergency_contact_no',
        ]));

        return back()->with('success', 'Profile updated successfully!');
    }
}
