<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class RoleController extends Controller
{
      // Menampilkan halaman pemilihan role
    public function select()
    {
        return view('role'); // Tampilkan view pemilihan role
    }

    // Menyimpan pilihan role
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,librarian', // Validasi role
        ]);

        // Simpan role ke session atau database sesuai kebutuhan
        $user = Auth::user();
        $user->admin = $request->role === 'admin';
        $user->save();

        // Arahkan pengguna ke halaman yang sesuai berdasarkan role
        return redirect()->route('home')->with('success', 'Role selected successfully.');
    }
}
