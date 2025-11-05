<?php

namespace App\Helpers;

use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SystemLogHelper
{
    public static function log($action, $details = null)
    {
        SystemLog::create([
            'user_id' => Auth::id(), // ✅ will match with users.id
            'action' => $action,
            'details' => $details,
            'ip_address' => Request::ip(),
        ]);
    }
}
