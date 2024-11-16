<?php

use Illuminate\Support\Facades\Route;
use App\Models\CD;
use App\Http\Controllers\CDController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\JurnalController;
use App\Models\FinalYearProject;
use App\Models\Newspaper;
use App\Http\Controllers\RoleController;
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

// Rute untuk pemilihan role
Route::get('/role/select', [RoleController::class, 'select'])->name('role.select');
Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');

// Rute untuk buku dengan middleware role.select
Route::middleware(['role.select'])->group(function () {
    Route::resource('buku', BukuController::class);
});