<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
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
    ];

    public function jurnal()
    {
    return $this->belongsTo(Jurnal::class, 'item_id'); // Assuming item_id refers to the Buku model
    }
}
