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
    // Find the user by user_id
    $user = User::findOrFail($user_id);

    // Validate input
    $request->validate([
        'credential_email' => 'required|email|unique:users,credential_email,' . $user->user_id . ',user_id',
        'role_id' => 'required|exists:roles,role_id', // ✅ validate role_id exists
        'password' => 'nullable|min:6|confirmed',
    ]);

    try {
        // Update credential_email
        $user->credential_email = $request->credential_email;

        // ✅ Update role
        $user->role_id = $request->role_id;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Save changes
        $user->save();

        // Redirect with success message
        return redirect()->route('admin_dashboard')
            ->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        // Redirect back with error message
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

        return redirect()->route('admin_dashboard')->with('success', 'User deleted successfully.');
    }
}
