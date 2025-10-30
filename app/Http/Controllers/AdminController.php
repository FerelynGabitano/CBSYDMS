<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Activity;

class AdminController extends Controller
{
    public function admin_dashboard()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        $activities = Activity::all();

        $totalMembers = $users->count();
        $upcomingEvents = $activities->where('date', '>=', now())->count();
        $newMembersThisMonth = $users->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $activeProjects = $activities->where('status', 'active')->count();

        return view('sections.dashboard', compact(
            'users',
            'roles',
            'totalMembers',
            'upcomingEvents',
            'newMembersThisMonth',
            'activeProjects'
        ));
    }

    public function dashboard()
    {
        return $this->admin_dashboard();
    }

    public function profile()
    {
        return view('sections.admin_profile');
    }

public function user_manage(Request $request)
{
    $roles = Role::all();
    $search = $request->input('search');
    $activeTab = $request->get('tab', 'no-credentials');

    // 🔹 Filter users WITHOUT credentials
    $noCredentialUsers = User::with('role')
        ->whereNull('credential_email')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('contact_number', 'like', "%{$search}%");
            });
        })
        ->paginate(5, ['*'], 'no_cred_page')
        ->appends(['tab' => 'no-credentials', 'search' => $search]);

    // 🔹 Filter users WITH credentials
    $withCredentialUsers = User::with('role')
        ->whereNotNull('credential_email')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('credential_email', 'like', "%{$search}%")
                    ->orWhere('contact_number', 'like', "%{$search}%");
            });
        })
        ->paginate(5, ['*'], 'with_cred_page')
        ->appends(['tab' => 'with-credentials', 'search' => $search]);

    return view('sections.user_manage', compact(
        'roles',
        'noCredentialUsers',
        'withCredentialUsers',
        'activeTab',
        'search'
    ));
}


}
