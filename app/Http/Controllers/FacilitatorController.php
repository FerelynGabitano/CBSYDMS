<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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

    public function storeActivity(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'start_datetime'   => 'required|date',
            'end_datetime'     => 'required|date|after:start_datetime',
            'location'         => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        Activity::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'start_datetime'   => $request->start_datetime,
            'end_datetime'     => $request->end_datetime,
            'location'         => $request->location,
            'max_participants' => $request->max_participants,
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

    /**
     * Download PDF of filtered activities
     */
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

        // Use your existing resources/views/pdf.blade.php
        $pdf = Pdf::loadView('pdf', compact('filtered', 'type', 'date', 'title'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('Activities_Report_' . ($type ?? 'All') . '.pdf');
    }

    /**
     * Route that triggers the filtering on the dashboard
     */
    public function filterReports(Request $request)
    {
        return $this->faci_dashboard($request);
    }
}
