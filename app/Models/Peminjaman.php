<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Specify the custom table name
    protected $table = 'peminjaman'; // Change this to your actual table name if different

    protected $fillable = [
        'user_id',
        'item_id',
        'jenis_item', // e.g., 'book', 'cd', etc.
        'dipinjam_sampai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'item_id'); // No filtering by jenis_item
    }

    public function cd()
    {
        return $this->belongsTo(CD::class, 'item_id'); // No filtering by jenis_item
    }

    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class, 'item_id'); // No filtering by jenis_item
    }
}

