<?php

namespace App\Http\Controllers;

use App\Models\SystemLog;

class SystemLogController extends Controller
{
    public function index()
    {
        // ✅ Load user data for each log
        $logs = SystemLog::with('user')->latest('created_at')->paginate(10);
        return view('sections.system_log', compact('logs'));
    }
}
