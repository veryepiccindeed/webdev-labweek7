<?php

use Illuminate\Support\Facades\Route;
use App\Models\CD;
use App\Models\FinalYearProject;
use App\Models\Newspaper;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/name', function () {
    return view('name'); // Menampilkan view 'name'
});

Route::get('/cd', function () {
    $cds = CD::orderBy('tahun_terbit', 'asc')->get(); // Default ke ascending
    return view('cd', compact('cds'));
});

Route::get('/final-year-projects', function () {
    $finalyearprojects = FinalYearProject::orderBy('tahun_terbit', 'asc')->get();
    return view('final-year-projects', compact('finalyearprojects'));
});

Route::get('/newspaper', function () {
    $newspapers = Newspaper::orderBy('tahun_terbit', 'asc')->get();
    return view('newspaper', compact('newspapers'));
});