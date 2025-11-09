<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // ✅ for logging
use App\Mail\SendUserCredentialsMail;
use App\Helpers\SystemLogHelper;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit_user', compact('user'));
    }

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

            $passwordSent = false;
            $plainPassword = $request->password;

            if ($request->filled('password')) {
                $user->password = bcrypt($plainPassword);
                $passwordSent = true;
            }

            $user->save();
        
            SystemLogHelper::log('update_user', "Updated user: {$user->first_name} {$user->last_name} ({$user->credential_email})");


            // ✅ Send credentials email if password was changed
            if ($passwordSent) {
                $roleName = Role::find($user->role_id)->role_name ?? 'User';

                try {
                    Mail::to($user->email)->send(
                        new SendUserCredentialsMail(
                            $user->email,              // for greeting in email
                            $user->credential_email,   // login email
                            $plainPassword,
                            $roleName
                        )
                    );
                    Log::info('Mail successfully sent to ' . $user->email);
                } catch (\Exception $e) {
                    Log::error('Mail failed: ' . $e->getMessage());
                }

                // ✅ Log event
                SystemLogHelper::log('email_sent', "Credentials sent to personal email: {$user->email}");
            }

            return redirect()->route('sections.user_manage')
                ->with('success', 'User updated successfully. Credentials email sent to user.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $userName = $user->first_name . ' ' . $user->last_name;
        $userEmail = $user->credential_email;

        $user->delete();

        // ✅ Log deletion
        SystemLogHelper::log('delete_user', "Deleted user: {$userName} ({$userEmail})");

        return redirect()->route('sections.user_manage')
            ->with('success', 'User deleted successfully.');
    }

}
