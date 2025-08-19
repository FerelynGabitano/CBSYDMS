<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function mem_dashboard()
    {
        return view('mem_dashboard'); // make sure mem_dashboard.blade.php exists
    }
}


