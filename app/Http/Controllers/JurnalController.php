<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'asc');
        $jurnals = Jurnal::orderBy('tahun_terbit', $sort)->get(); // Ambil semua jurnal yang sudah diurutkan
        return view('jurnal', compact('jurnals', 'sort')); // Kirimkan data ke view
    }

    public function create()
    {
        return view('jurnal'); // Tampilkan form untuk menambah jurnal
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit' => 'required',
            'penulis' => 'required',
            'jumlah_halaman' => 'required|integer|min:1',
        ]);

        Jurnal::create($request->all()); // Simpan jurnal baru
        return redirect()->route('jurnal.index'); // Arahkan kembali ke daftar jurnal
    }

    public function edit($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $jurnals = Jurnal::all(); // Ambil semua jurnal untuk ditampilkan di tabel
        return view('jurnal', compact('jurnal', 'jurnals')); // Kirimkan data jurnal dan daftar jurnal ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit' => 'required',
            'penulis' => 'required',
            'jumlah_halaman' => 'required|integer|min:1',
        ]);

        $jurnal = Jurnal::findOrFail($id);
        $jurnal->update($request->all()); // Memperbarui data jurnal
        return redirect()->route('jurnal.index'); // Arahkan kembali ke daftar jurnal
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $jurnal->delete(); // Hapus jurnal
        return redirect()->route('jurnal.index'); // Arahkan kembali ke daftar jurnal
    }
}
