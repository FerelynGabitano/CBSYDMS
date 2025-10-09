<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // Redirect based on role_id
                if ($user->role_id == 1) {
                    return redirect()->route('mem_dashboard');
                } elseif ($user->role_id == 2) {
                    return redirect()->route('faci_dashboard');
                } elseif ($user->role_id == 3) {
                    return redirect()->route('admin_dashboard');
                }
            }
        }

        return $next($request);
    }
}
