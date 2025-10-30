<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit_user', compact('user')); 
    }

    // Update user
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $request->validate([
            'credential_email' => 'required|email|unique:users,credential_email,' . $user->user_id . ',user_id',
            'role_id' => 'required|exists:roles,role_id',
            'password' => 'nullable|min:6|confirmed',
        ]);

        try {
            $user->credential_email = $request->credential_email;
            $user->role_id = $request->role_id;

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            // ✅ Redirect to User Management page instead of Dashboard
            return redirect()->route('sections.user_manage')
                ->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // ✅ Redirect to User Management page instead of Dashboard
        return redirect()->route('sections.user_manage')
            ->with('success', 'User deleted successfully.');
    }
}