<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function join($id)
    {
        $userId = Auth::id();

        // Must be logged in
        if (!$userId) {
            return redirect()->route('login')->with('error', 'You must be logged in to join an activity.');
        }

        // Check if already joined
        $alreadyJoined = DB::table('activity_participants')
            ->where('user_id', $userId)
            ->where('activity_id', $id)
            ->exists();

        if ($alreadyJoined) {
            return back()->with('success', 'You have already joined this activity.');
        }

        // Insert into existing table structure
        DB::table('activity_participants')->insert([
            'user_id' => $userId,
            'activity_id' => $id,
            'attendance_status' => 'Pending', // or null if you prefer
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'You successfully joined the activity!');
    }
}
