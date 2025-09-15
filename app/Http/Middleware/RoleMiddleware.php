<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($role === 'member' && $user->role_id != 1) {
            abort(403, 'Unauthorized');
        }

        if ($role === 'admin' && $user->role_id != 3) {
            abort(403, 'Unauthorized');
        }

        if ($role === 'facilitator' && $user->role_id != 2) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
