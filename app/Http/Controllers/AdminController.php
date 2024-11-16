<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
     // Menampilkan daftar librarian
     public function index()
     {
         $librarians = User::where('role', 'librarian')->get(); // Ambil semua librarian
         return view('admin.librarians.index', compact('librarians')); // Tampilkan view dengan data librarian
     }
 
     // Menampilkan form untuk menambahkan librarian
     public function create()
     {
         return view('admin.librarians.create'); // Tampilkan form untuk menambah librarian
     }
 
     // Menyimpan librarian baru
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:8|confirmed',
         ]);
 
         User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => bcrypt($request->password),
             'role' => 'librarian', // Pastikan ada kolom role di tabel users
         ]);
 
         return redirect()->route('admin.librarians.index')->with('success', 'Librarian added successfully.');
     }
 
     // Menghapus librarian
     public function destroy($id)
     {
         $librarian = User::findOrFail($id);
         $librarian->delete(); // Hapus librarian
         return redirect()->route('admin.librarians.index')->with('success', 'Librarian deleted successfully.');
     }
 
     // Metode lain untuk mengelola permintaan dari librarian (jika ada)
     public function showRequests()
     {
         // Logika untuk menampilkan permintaan dari librarian
         // Misalnya, ambil data dari tabel permintaan
         // $requests = RequestModel::all(); // Contoh
         // return view('admin.requests', compact('requests'));
     }
 
     // Meng-acc permintaan librarian
     public function approveRequest($id)
     {
         // Logika untuk meng-acc permintaan
         // $request = RequestModel::findOrFail($id);
         // $request->status = 'approved';
         // $request->save();
         // return redirect()->back()->with('success', 'Request approved successfully.');
     }
 
     // Menolak permintaan librarian
     public function rejectRequest($id)
     {
         // Logika untuk menolak permintaan
         // $request = RequestModel::findOrFail($id);
         // $request->status = 'rejected';
         // $request->save();
         // return redirect()->back()->with('success', 'Request rejected successfully.');
     }
}
