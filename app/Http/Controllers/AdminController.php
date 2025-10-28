<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function admin_dashboard()
    {
        // Fetch all users with their roles
        $users = User::with('role')->get();

        // Fetch all roles for dropdowns
        $roles = Role::all();

        // Pass them to your blade file
        return view('admin_dashboard', compact('users', 'roles'));
    }

    public function profile()
    {
        return view('sections.admin_profile');
    }
}

