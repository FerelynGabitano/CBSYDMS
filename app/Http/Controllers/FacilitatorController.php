<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Helpers\SystemLogHelper as LogHelper;


class FacilitatorController extends Controller
{
    // Dashboard view
    public function faci_dashboard()
    {
        $activities = Activity::latest()->get();
        $members = User::all();
        $sponsors = Sponsor::all();
        $regularFacilitators = User::where('role_id', 2)->get();

        return view('faci_dashboard', compact(
            'activities',
            'members',
            'sponsors',
            'regularFacilitators'
        ));
    }

    // Activities feed
    public function faci_activities_feed(Request $request)
    {
        $query = Activity::with('leadFacilitator');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
            })
            ->orWhereHas('sponsor', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Paginate results (10 per page)
        $activities = $query->latest()->paginate(8);

        $regularFacilitators = User::where('role_id', 2)->get();
        $sponsors = Sponsor::all();

        return view('sections.activities_feed', compact('activities', 'regularFacilitators','sponsors'));
    }

    // CRUD Activities
    public function storeActivity(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'lead_facilitator_id' => 'nullable|exists:users,user_id',
            'sponsor_id' => 'nullable|exists:sponsors,sponsor_id',
        ]);

        $activity = Activity::create(array_merge(
            $request->only(['title','description','start_datetime','end_datetime','location','max_participants','lead_facilitator_id','sponsor_id']),
            ['created_by' => Auth::id()]
        ));

        LogHelper::log('create_activity', 'Created activity: ' . $activity->title);

        return redirect()->route('faci_dashboard')->with('success', 'Activity posted successfully!');
    }

    public function updateActivity(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'lead_facilitator_id' => 'nullable|exists:users,user_id',
            'sponsor_id' => 'nullable|exists:sponsors,sponsor_id',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->only(['title','description','start_datetime','end_datetime','location','max_participants','lead_facilitator_id','sponsor_id']));

        LogHelper::log('update_activity', 'Updated activity: ' . $activity->title);

        return redirect()->route('faci_dashboard')->with('success', 'Activity updated successfully!');
    }

    public function destroyActivity($id)
    {
        $activity = Activity::findOrFail($id);

        LogHelper::log('delete_activity', 'Deleted activity: ' . $activity->title);

        $activity->delete();

        return redirect()->route('sections.activities_feed')->with('success', 'Activity deleted successfully!');
    }


    // Attendance
    public function updateAttendance(Request $request, $activity_id)
    {
        $activity = Activity::with('participants')->findOrFail($activity_id);

        foreach ($activity->participants as $participant) {
            $status = $request->attendance[$participant->user_id] ?? 'absent';
            $activity->participants()->updateExistingPivot($participant->user_id, ['attendance_status' => $status]);
        }

        return response()->json(['success' => true]);
    }

    // Sponsors CRUD
    public function storeSponsor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
        ]);

        $sponsor = Sponsor::create($request->only(['name','contact_person','email','phone','address']));

        LogHelper::log('create_sponsor', 'Added sponsor: ' . $sponsor->name);

        return redirect()->route('faci.sponsor.index')->with('success', 'Sponsor added successfully!');
    }

    public function updateSponsor(Request $request, $id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->update($request->only(['name','contact_person','email','phone','address']));

        LogHelper::log('update_sponsor', 'Updated sponsor: ' . $sponsor->name);

        return redirect()->route('faci.sponsor.index')->with('success', 'Sponsor updated successfully!');
    }

    public function destroySponsor($id)
    {
        $sponsor = Sponsor::findOrFail($id);

        LogHelper::log('delete_sponsor', 'Deleted sponsor: ' . $sponsor->name);

        $sponsor->delete();

        return redirect()->route('faci.sponsor.index')->with('success', 'Sponsor deleted successfully!');
    }

    // Reports
    public function downloadReport(Request $request)
    {
        $search = $request->input('search');

        $activities = Activity::with('leadFacilitator')->latest();

        if ($search) {
            $activities->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $activities = $activities->get();

        if ($activities->isEmpty()) {
            // Optional: handle empty PDF gracefully
            $pdf = Pdf::loadView('reports.pdf_empty')->setPaper('a4','portrait');
            return $pdf->download('Activities_Report.pdf');
        }

        $pdf = Pdf::loadView('reports.pdf', compact('activities'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('Activities_Report.pdf');
    }



    public function previewActivityReport($id)
    {
        $activity = Activity::with('leadFacilitator')->findOrFail($id);
        $pdf = Pdf::loadView('reports.pdf_single', compact('activity'))->setPaper('a4','portrait');

        return $pdf->stream('Activity_Report_' . $activity->activity_id . '.pdf');
    }

    public function downloadActivityReport($id)
    {
        $activity = Activity::with('leadFacilitator')->findOrFail($id);
        $pdf = Pdf::loadView('reports.pdf_single', compact('activity'))->setPaper('a4','portrait');

        return $pdf->download('Activity_Report_' . $activity->activity_id . '.pdf');
    }

    public function faci_reports(Request $request)
    {
        $search = $request->input('search');

        $query = Activity::latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
            })
            ->orWhereHas('sponsor', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Paginate results (10 per page)
        $activities = $query->paginate(10);

        return view('sections.reports', compact('activities', 'search'));
    }


    // Profile
    public function faci_profile()
    {
        return view('sections.faci_profile', ['user' => Auth::user()]);
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate(['profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048']);

        $user = Auth::user();
        $path = $request->file('profile_picture')->store('profile_pictures','public');

        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->update(['profile_picture' => $path]);
        return back()->with('success', 'Profile picture updated successfully!');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
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

        $user->update($request->only([
            'first_name','middle_name','last_name','contact_number','email',
            'street_address','barangay','city_municipality','province','zip_code',
            'school','course','gradeLevel','skills','emergency_contact_no'
        ]));

        return back()->with('success', 'Profile updated successfully!');
    }

    // Members & Sponsors
    public function faci_members()
    {
        return view('sections.member', ['members' => User::all()]);
    }

    public function faci_sponsors(Request $request)
    {
        $query = Sponsor::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('contact_person', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Paginate (10 per page)
        $sponsors = $query->latest()->paginate(8);

        return view('sections.sponsors', compact('sponsors'));
    }

    public function viewScholarRequests(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $members = $query->paginate(10); // paginate 10 per page

        return view('sections.mem_scholar_req', compact('members'));
    }

}
