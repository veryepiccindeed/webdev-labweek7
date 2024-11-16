<?php

namespace App\Http\Controllers;

use App\Models\CD;
use Illuminate\Http\Request;

class CDController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'asc');
        $cds = CD::orderBy('tahun_terbit', $sort)->get();
        return view('cd', compact('cds', 'sort'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit' => 'required',
        ]);

        CD::create($request->all());
        return redirect()->route('cd.index');
    }

    public function edit($id)
    {
        $cd = CD::findOrFail($id);
        $cds = CD::all(); // Ambil semua CD untuk ditampilkan di tabel
        return view('cd', compact('cd', 'cds')); // Mengarahkan ke halaman yang sama dengan data CD
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit' => 'required',
        ]);

        $cd = CD::findOrFail($id);
        $cd->update($request->all());
        return redirect()->route('cd.index');
    }

    public function destroy($id)
    {
        $cd = CD::findOrFail($id);
        $cd->delete();
        return redirect()->route('cd.index');
    }
}
