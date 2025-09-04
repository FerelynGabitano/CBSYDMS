<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function admin_dashboard()
    {
        // Fetch all users from the database
        $users = User::all();

        // Pass them to your blade file
        return view('admin_dashboard', compact('users'));
    }
}
