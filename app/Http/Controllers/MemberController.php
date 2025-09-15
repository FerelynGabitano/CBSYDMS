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
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'phone'             => 'nullable|string|max:20',
            'address'           => 'nullable|string|max:255',
            'barangay'          => 'nullable|string|max:255',
            'education'         => 'nullable|string|max:255',
            'course'            => 'nullable|string|max:255',
            'skills'            => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
        ]);

        $user->update($request->only([
            'first_name',
            'last_name',
            'phone',
            'address',
            'barangay',
            'education',
            'course',
            'skills',
            'emergency_contact',
        ]));

        return back()->with('success', 'Profile updated successfully!');
    }
}
