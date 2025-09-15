<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberController extends Controller
{
public function mem_dashboard()
{
    $now = \Carbon\Carbon::now();

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

}
