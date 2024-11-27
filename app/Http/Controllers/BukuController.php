<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('role.select'); // Pastikan pengguna telah memilih role
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'asc');
        $bukus = Buku::orderBy('tahun_terbit', $sort)->get(); // Ambil semua buku yang sudah diurutkan
        return view('buku', compact('bukus', 'sort')); // Kirimkan data ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'jumlah_halaman' => 'required|integer|min:1',
        ]);

        if (Auth::user()->isLibrarian()) {
            // Simpan ke tabel Status dengan isApproved = false
            Status::create([
                'judul' => $request->judul,
                'tahun_terbit' => $request->tahun_terbit,
                'penerbit' => $request->penerbit,
                'penulis' => $request->penulis,
                'jumlah_halaman' => $request->jumlah_halaman,
                'koleksi' => 'buku',
                'isApproved' => false,
            ]);

            return redirect()->route('buku.index')->with('success', 'Buku submitted for approval.');
        }

        if (Auth::user()->isAdmin()) {
            // Simpan langsung ke tabel Buku
            Buku::create($request->all());

            return redirect()->route('buku.index')->with('success', 'Buku added successfully.');
        }

        return redirect()->route('buku.index')->with('error', 'Unauthorized access.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $bukus = Buku::all(); // Ambil semua buku untuk ditampilkan di tabel
        $sort = request('sort', 'asc'); // Dapatkan parameter sort dari request
        return view('buku', compact('buku', 'bukus', 'sort')); // Kirimkan data ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'jumlah_halaman' => 'required|integer|min:1',
        ]);

        if (Auth::user()->isLibrarian()) {
            // Simpan perubahan ke tabel Status dengan isApproved = false
            Status::create([
                'judul' => $request->judul,
                'tahun_terbit' => $request->tahun_terbit,
                'penerbit' => $request->penerbit,
                'penulis' => $request->penulis,
                'jumlah_halaman' => $request->jumlah_halaman,
                'koleksi' => 'buku',
                'isApproved' => false,
            ]);

            return redirect()->route('buku.index')->with('success', 'Buku update submitted for approval.');
        }

        if (Auth::user()->isAdmin()) {
            // Update langsung di tabel Buku
            $buku = Buku::findOrFail($id);
            $buku->update($request->all());

            return redirect()->route('buku.index')->with('success', 'Buku updated successfully.');
        }

        return redirect()->route('buku.index')->with('error', 'Unauthorized access.');
    }

    public function destroy($id)
    {
        if (Auth::user()->isLibrarian()) {
            // Simpan permintaan penghapusan ke tabel Status dengan isApproved = false
            $buku = Buku::findOrFail($id);
            Status::create([
                'judul' => $buku->judul,
                'tahun_terbit' => $buku->tahun_terbit,
                'penerbit' => $buku->penerbit,
                'penulis' => $buku->penulis,
                'jumlah_halaman' => $buku->jumlah_halaman,
                'koleksi' => 'buku',
                'isApproved' => false,
            ]);

            return redirect()->route('buku.index')->with('success', 'Buku deletion submitted for approval.');
        }

        if (Auth::user()->isAdmin()) {
            // Hapus langsung dari tabel Buku
            $buku = Buku::findOrFail($id);
            $buku->delete();

            return redirect()->route('buku.index')->with('success', 'Buku deleted successfully.');
        }

        return redirect()->route('buku.index')->with('error', 'Unauthorized access.');
    }
}
