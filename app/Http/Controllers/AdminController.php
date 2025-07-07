<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function admin_dashboard()
    {
        return view('admin_dashboard');
    }
}