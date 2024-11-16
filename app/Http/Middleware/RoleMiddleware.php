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
       
         if (Auth::check()) {
             \Log::info('User role:', ['isAdmin' => Auth::user()->isAdmin(), 'isLibrarian' => Auth::user()->isLibrarian()]);
         }

         if (Auth::check() && !Auth::user()->isAdmin() && !Auth::user()->isLibrarian()) {
             return redirect()->route('role'); // Arahkan ke halaman pemilihan role
         }

        return $next($request);
    }
}
