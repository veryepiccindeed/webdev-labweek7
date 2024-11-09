<?php

namespace App\Http\Controllers;

use App\Models\CD;
use Illuminate\Http\Request;

class CDController extends Controller
{
    /**
     * Menampilkan daftar CD dengan sorting.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Mendapatkan opsi sorting dari query parameter
        $sort = $request->query('sort', 'asc'); // Default ke 'asc'
        
        // Mengambil data CD dengan sorting berdasarkan `tahun_terbit`
        $cds = CD::orderBy('tahun_terbit', $sort)->get();
        
        return view('cd.index', compact('cds', 'sort'));
    }
}
