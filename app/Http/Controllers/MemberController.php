<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function mem_dashboard()
    {
        $now = Carbon::now();
        $user = Auth::user();

        // ✅ Active (ongoing) activities
        $activeActivities = Activity::where('is_active', true)
            ->where('start_datetime', '<=', $now)
            ->where(function ($q) use ($now) {
                $q->where('end_datetime', '>=', $now)
                  ->orWhereNull('end_datetime');
            })
            ->get();

        // ✅ Upcoming (future) activities
        $upcomingActivities = Activity::where('is_active', true)
            ->where('start_datetime', '>', $now)
            ->get();

        // ✅ All activities joined by this user
        $history = DB::table('activity_participants')
            ->join('activities', 'activity_participants.activity_id', '=', 'activities.activity_id')
            ->where('activity_participants.user_id', $user->user_id)
            ->select('activities.*', 'activity_participants.attendance_status', 'activity_participants.created_at as joined_at')
            ->orderBy('activity_participants.created_at', 'desc')
            ->get();

        // ✅ Participation stats
        $joinedCount = $history->count();

        $completedCount = $history->filter(function ($a) use ($now) {
            return $a->end_datetime && Carbon::parse($a->end_datetime)->isPast();
        })->count();

        $ongoingCount = $history->filter(function ($a) use ($now) {
            return Carbon::parse($a->start_datetime)->isPast() &&
                   (!$a->end_datetime || Carbon::parse($a->end_datetime)->isFuture());
        })->count();

        $upcomingCount = $history->filter(function ($a) use ($now) {
            return Carbon::parse($a->start_datetime)->isFuture();
        })->count();

        return view('mem_dashboard', compact(
            'activeActivities',
            'upcomingActivities',
            'history',
            'joinedCount',
            'completedCount',
            'ongoingCount',
            'upcomingCount'
        ));
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::find(Auth::id());
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

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
        $user = Auth::user();

        $validated = $request->validate([
            'first_name'=>'required|string|max:255',
            'middle_name'=>'nullable|string|max:255',
            'last_name'=>'required|string|max:255',
            'contact_number'=>'nullable|string|max:20',
            'email'=>'required|email|max:255',
            'street_address'=>'nullable|string|max:255',
            'barangay'=>'nullable|string|max:255',
            'city_municipality'=>'nullable|string|max:255',
            'province'=>'nullable|string|max:255',
            'zip_code'=>'nullable|string|max:10',
            'school'=>'nullable|string|max:255',
            'course'=>'nullable|string|max:255',
            'gradeLevel'=>'nullable|string|max:50',
            'skills'=>'nullable|string|max:255',
            'emergency_contact_no'=>'nullable|string|max:255',
        ]);

        $user->fill($validated);
        $user->save();

        // Refresh Auth user so Blade uses updated data
        Auth::setUser($user->fresh());

        return back()->with('success', 'Profile updated successfully!');
    }

    /** ✅ JOIN ACTIVITY FUNCTION **/
    public function joinActivity($activityId)
    {
        $user = Auth::user();

        if (DB::table('activity_participants')
            ->where('user_id', $user->user_id)
            ->where('activity_id', $activityId)
            ->exists()) {
            return back()->with('success', 'You already joined this activity.');
        }

        DB::table('activity_participants')->insert([
            'user_id' => $user->user_id,
            'activity_id' => $activityId,
            'attendance_status' => 'registered',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'You have successfully joined the activity!');
    }

    // ------------------------------
    // New section-based views
    // ------------------------------

    public function activities()
    {
        $now = now();

        $activeActivities = Activity::where('is_active', true)
            ->where('start_datetime', '<=', $now)
            ->where(function ($q) use ($now) {
                $q->where('end_datetime', '>=', $now)
                  ->orWhereNull('end_datetime');
            })
            ->get();

        $upcomingActivities = Activity::where('is_active', true)
            ->where('start_datetime', '>', $now)
            ->get();

        return view('sections.activities', compact('activeActivities', 'upcomingActivities'));
    }

    public function profile()
{
    $user = Auth::user();
    return view('sections.profile', compact('user'));
}
    public function participation()
    {
        $user = Auth::user();
        $now = now();

        $history = DB::table('activity_participants')
            ->join('activities', 'activity_participants.activity_id', '=', 'activities.activity_id')
            ->where('activity_participants.user_id', $user->user_id)
            ->select('activities.*', 'activity_participants.attendance_status', 'activity_participants.created_at as joined_at')
            ->orderBy('activity_participants.created_at', 'desc')
            ->get();

        $joinedCount = $history->count();
        $completedCount = $history->filter(fn($a) => $a->end_datetime && Carbon::parse($a->end_datetime)->isPast())->count();
        $ongoingCount = $history->filter(fn($a) => Carbon::parse($a->start_datetime)->isPast() && (!$a->end_datetime || Carbon::parse($a->end_datetime)->isFuture()))->count();
        $upcomingCount = $history->filter(fn($a) => Carbon::parse($a->start_datetime)->isFuture())->count();

        return view('sections.participation', compact(
            'history',
            'joinedCount',
            'completedCount',
            'ongoingCount',
            'upcomingCount'
        ));
    }

    public function gallery()
    {
        return view('sections.gallery');
    }

    public function scholarships()
    {
        $user = Auth::user();
        return view('sections.scholarships', compact('user'));
    }
}
