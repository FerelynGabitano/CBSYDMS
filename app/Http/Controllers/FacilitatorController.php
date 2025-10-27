<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FacilitatorController extends Controller
{
    public function faci_dashboard(Request $request)
    {
        $activities = Activity::latest()->get();
        $members = User::all();
        $sponsors = Sponsor::all();
        $regularFacilitators = User::where('role_id', 2)->get();

        $filter = $request->input('filter') ?? $request->input('type');
        $filtered = null;
        $type = 'All';
        $date = $request->input('date', now()->toDateString());

        if ($filter === 'daily') {
            $filtered = Activity::whereDate('created_at', $date)->get();
            $type = 'Daily';
        } elseif ($filter === 'monthly') {
            $d = Carbon::parse($date);
            $filtered = Activity::whereMonth('created_at', $d->month)
                                ->whereYear('created_at', $d->year)
                                ->get();
            $type = 'Monthly';
        } elseif ($filter === 'annual') {
            $d = Carbon::parse($date);
            $filtered = Activity::whereYear('created_at', $d->year)->get();
            $type = 'Annual';
        }

        return view('faci_dashboard', compact(
            'activities',
            'filtered',
            'members',
            'sponsors',
            'regularFacilitators',
            'filter',
            'type',
            'date'
        ));
    }
    public function faci_activities_feed()
{
    $activities = \App\Models\Activity::with('leadFacilitator')->latest()->get();
    $regularFacilitators = \App\Models\User::where('role_id', 2)->get();

    return view('sections.activities_feed', compact('activities', 'regularFacilitators'));
}

    public function storeActivity(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'start_datetime'   => 'required|date',
            'end_datetime'     => 'required|date|after:start_datetime',
            'location'         => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'lead_facilitator_id' => 'nullable|exists:users,user_id',
        ]);

        Activity::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'start_datetime'   => $request->start_datetime,
            'end_datetime'     => $request->end_datetime,
            'location'         => $request->location,
            'max_participants' => $request->max_participants,
            'lead_facilitator_id' => $request->lead_facilitator_id,
            'created_by'       => Auth::id(),
        ]);

        return redirect()->route('faci_dashboard')->with('success', 'Activity posted successfully!');
    }

    public function updateActivity(Request $request, $id)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'start_datetime'   => 'required|date',
            'end_datetime'     => 'required|date|after:start_datetime',
            'location'         => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'lead_facilitator_id' => 'nullable|exists:users,user_id',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->only([
            'title', 'description', 'start_datetime', 'end_datetime',
            'location', 'max_participants', 'lead_facilitator_id'
        ]));

        return redirect()->route('faci_dashboard')->with('success', 'Activity updated successfully!');
    }

    public function destroyActivity($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('faci_dashboard')->with('success', 'Activity deleted successfully!');
    }

    public function updateAttendance(Request $request)
    {
        if ($request->has('attendance')) {
            foreach ($request->attendance as $memberId => $status) {
                $member = User::find($memberId);
                if ($member) {
                    $member->attendance = $status ? 1 : 0;
                    $member->save();
                }
            }
        }

        return redirect()->route('faci_dashboard')->with('success', 'Attendance updated!');
    }

    public function storeSponsor(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email'          => 'nullable|email|max:255',
            'phone'          => 'nullable|string|max:50',
            'address'        => 'nullable|string|max:500',
            'logo_path'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo_path')) {
            $logoPath = $request->file('logo_path')->store('sponsors', 'public');
        }

        Sponsor::create([
            'name'           => $request->name,
            'contact_person' => $request->contact_person,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'logo_path'      => $logoPath,
        ]);

        return redirect()->route('faci_dashboard')->with('success', 'Sponsor added successfully!');
    }

    public function downloadReport(Request $request)
    {
        $filter = $request->input('filter');
        $date = $request->input('date', now()->toDateString());
        $filtered = collect();
        $type = 'All';
        $title = 'All Activities Report';

        if ($filter === 'daily') {
            $filtered = Activity::whereDate('created_at', $date)->get();
            $type = 'Daily';
            $title = 'Daily Activities Report (' . Carbon::parse($date)->toFormattedDateString() . ')';
        } elseif ($filter === 'monthly') {
            $d = Carbon::parse($date);
            $filtered = Activity::whereMonth('created_at', $d->month)
                                ->whereYear('created_at', $d->year)
                                ->get();
            $type = 'Monthly';
            $title = 'Monthly Activities Report (' . $d->format('F Y') . ')';
        } elseif ($filter === 'annual') {
            $d = Carbon::parse($date);
            $filtered = Activity::whereYear('created_at', $d->year)->get();
            $type = 'Annual';
            $title = 'Annual Activities Report (' . $d->format('Y') . ')';
        } else {
            $filtered = Activity::latest()->get();
        }

        $pdf = Pdf::loadView('pdf', compact('filtered', 'type', 'date', 'title'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('Activities_Report_' . ($type ?? 'All') . '.pdf');
    }

    public function filterReports(Request $request)
    {
        return $this->faci_dashboard($request);
    }
     public function faci_profile()
{
    $user = Auth::user();
    return view('sections.faci_profile', compact('user'));
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

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

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

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->contact_number = $request->contact_number;
        $user->street_address = $request->street_address;
        $user->barangay = $request->barangay;
        $user->city_municipality = $request->city_municipality;
        $user->province = $request->province;
        $user->zip_code = $request->zip_code;
        $user->school = $request->school;
        $user->course = $request->course;
        $user->gradeLevel = $request->gradeLevel;
        $user->skills = $request->skills;
        $user->emergency_contact_no = $request->emergency_contact_no;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function faci_members()
    {
        $members = User::all();
        return view('sections.member', compact('members'));
    }

    public function faci_sponsors()
    {
        $sponsors = Sponsor::all();
        return view('sections.sponsors', compact('sponsors'));
    }

    public function faci_reports(Request $request)
    {
        $activities = Activity::latest()->get();
        $filter = $request->input('filter');
        $date = $request->input('date', now()->toDateString());
        $filtered = collect();
        $type = 'All';

        if ($filter === 'daily') {
            $filtered = Activity::whereDate('created_at', $date)->get();
            $type = 'Daily';
        } elseif ($filter === 'monthly') {
            $d = Carbon::parse($date);
            $filtered = Activity::whereMonth('created_at', $d->month)
                                ->whereYear('created_at', $d->year)
                                ->get();
            $type = 'Monthly';
        } elseif ($filter === 'annual') {
            $d = Carbon::parse($date);
            $filtered = Activity::whereYear('created_at', $d->year)->get();
            $type = 'Annual';
        }

        return view('sections.reports', compact('activities', 'filtered', 'filter', 'type', 'date'));
    }
}
