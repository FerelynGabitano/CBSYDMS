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
        // Default: show all activities in the dashboard
        $activities = Activity::latest()->get();
        $members = User::all();
        $sponsors = Sponsor::all();
        $regularFacilitators = User::where('role_id', 2)->get();

        // If filter was provided in the dashboard (optional)
        $filter = $request->input('filter'); // 'daily'|'monthly'|'annual' or null
        $filtered = null;
        $type = 'All';
        $date = $request->input('date', now()->toDateString());

        if ($filter === 'daily') {
            $filtered = Activity::whereDate('created_at', $date)->get();
            $type = 'Daily';
        } elseif ($filter === 'monthly') {
            // if user passed a date, use that month/year; otherwise current month
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
            'filtered',          // collection or null
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
     * Generates a PDF for the filtered activities.
     * Accepts GET params: filter (daily|monthly|annual), date (Y-m-d) (optional)
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

        // Ensure you have resources/views/reports/pdf.blade.php
        $pdf = Pdf::loadView('reports.pdf', compact('filtered', 'type', 'date', 'title'));
        return $pdf->download('Activities_Report_' . ($type ?? 'All') . '.pdf');
    }

    /**
     * Endpoint used by the reports form (if you want a dedicated route).
     * Returns the dashboard view with the filtered result inserted into the reports tab.
     */
    public function filterReports(Request $request)
    {
        // We'll reuse faci_dashboard logic: forward request to faci_dashboard
        return $this->faci_dashboard($request);
    }
}
