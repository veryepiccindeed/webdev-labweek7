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

    
}
