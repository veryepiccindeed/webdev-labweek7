<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CDController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Route for role selection, protected by auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/role/select', [RoleController::class, 'select'])->name('role.select');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
});


// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login'); // Display the login view
    })->name('login');

    Route::post('/login', function (Request $request) {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user using plain text password
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user->password === $request->password) {
            Auth::login($user); // Log in the user
            return redirect()->route('role.select'); // Redirect to the role selection page
        }

        // Redirect back to the login page with an error message if login fails
        return redirect()->route('login')->withErrors(['msg' => 'Invalid credentials.']);
    })->name('login.simple');
});

// Protected routes requiring authentication and role selection
Route::middleware(['auth', 'role.select'])->group(function () {
    Route::resource('buku', BukuController::class);
    Route::resource('cd', CDController::class);
    Route::resource('jurnal', JurnalController::class);
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman', [PeminjamanController::class, 'borrow'])->name('peminjaman.borrow');
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login')->with('success', 'You have been logged out.');
})->name('logout');

Route::get('/clear-session', function () {
    session()->flush(); // Clear all session data
    return redirect()->route('login')->with('success', 'Session cleared. You can log in again.');
})->name('clear.session');