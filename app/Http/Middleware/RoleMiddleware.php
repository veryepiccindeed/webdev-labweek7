<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            // Check if the user has a valid role
            if (in_array($user->role, ['admin', 'librarian', 'lecturer', 'student'])) {
                return $next($request); // Proceed to the next request
            }
        }

        // Redirect to role selection if the user is authenticated but has not selected a valid role
        return redirect()->route('role.select')->with('error', 'Please select a valid role to continue.');
    }
}

    

