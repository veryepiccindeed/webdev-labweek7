<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'tahun_terbit',
        'penerbit',
        'penulis',
        'jumlah_halaman',
        'koleksi',
        'isApproved',
    ];
}
