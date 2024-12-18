<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CD extends Model
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
    ];

    public function cd()
    {
    return $this->belongsTo(CD::class, 'item_id'); // Assuming item_id refers to the Buku model
    }
}
