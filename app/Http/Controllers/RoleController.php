<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
   /**
     * Show the role selection form.
     *
     * @return \Illuminate\View\View
     */
    public function select()
    {
        // Define the available roles
        $roles = [
            'admin' => 'Admin',
            'librarian' => 'Librarian',
            'lecturer' => 'Lecturer',
            'student' => 'Student',
        ];

        return view('role', compact('roles'));
    }

    /**
     * Store the selected role for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'role' => 'required|in:admin,librarian,lecturer,student', // Ensure the role is valid
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's role
        $user->role = $request->input('role');
        $user->save();

        // Redirect to a desired page with a success message
        return redirect()->route('buku.index')->with('success', 'Role has been successfully assigned.');
    }
}
