<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('judul');
            $table->integer('tahun_terbit');
            $table->string('penerbit');
            $table->string('penulis');
            $table->integer('jumlah_halaman');
            $table->string('koleksi');
            $table->boolean('isApproved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
