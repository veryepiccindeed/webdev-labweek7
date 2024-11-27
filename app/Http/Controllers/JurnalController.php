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

}
