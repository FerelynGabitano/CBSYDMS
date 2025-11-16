<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemLog;

class SystemLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $logs = SystemLog::with('user')
            ->when($search, function ($query, $search) {
                $query->where('action', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q) use ($search) {
                          $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                      });
            })
            ->latest('created_at')
            ->paginate(10);

        return view('sections.system_log', compact('logs'));
    }
}
