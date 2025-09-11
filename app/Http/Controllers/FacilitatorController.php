<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;    

class FacilitatorController extends Controller
{
    public function faci_dashboard()
    {
        // Fetch data to display in the dashboard
        $activities = Activity::latest()->get();
        $members    = User::all();
        $sponsors   = Sponsor::all();

        return view('faci_dashboard', compact('activities', 'members', 'sponsors'));
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
        'created_by'       => Auth::id(), // stores the logged-in user's ID
    ]);

    // Redirect back to facilitator dashboard with a success message
    return redirect()->route('faci_dashboard')->with('success', 'Activity posted successfully!');
}

    // 📌 Handle attendance update
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

    // 📌 Handle sponsor logging
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

        // ✅ If logo is uploaded, save file
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
}
