<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }
    
    /**
     * Display a listing of the borrowed items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Log::info('Accessing the Peminjaman index method.');
        // Get the current user's borrowings
        $borrowings = Auth::user()->peminjaman; // This will retrieve all related Peminjaman records

        return view('peminjaman', compact('borrowings')); // Pass the data to the view
    }

    /**
     * Borrow an item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function borrow(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer', // Validate that item_id is an integer
            'jenis_item' => 'required|string', // Validate that item_type is a string
        ]);

        $user = Auth::user();
        $borrowDuration = 0;

        // Determine borrow duration based on user role
        if ($user->role === 'student') {
            $borrowDuration = 5; // 5 days
        } elseif ($user->role === 'lecturer') {
            $borrowDuration = 3; // 3 days
        } else {
            Log::warning('Unauthorized borrow attempt by user ID: ' . $user->id);
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Log the borrowing attempt
        Log::info('User ID ' . $user->id . ' is attempting to borrow item ID ' . $request->input('item_id'));

        // Create a new borrowing record
        Peminjaman::create([
            'user_id' => $user->id,
            'item_id' => $request->input('item_id'), // Use the actual item_id from the request
            'jenis_item' => $request->input('jenis_item'), // Use the actual item_type from the request
            'dipinjam_sampai' => now()->addDays($borrowDuration),
        ]);

        // Log the successful borrowing
        Log::info('User ID ' . $user->id . ' successfully borrowed item ID ' . $request->input('item_id'));

        return response()->json(['success' => 'Item successfully borrowed.']);
    }
}
