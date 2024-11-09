<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CD;
use App\Models\Newspaper;
use App\Models\FinalYearProject;

class BuatNgisiTugas extends Seeder
{
    /**
     * Run the database seeds.
     * 
     */
    public function run(): void
    {
        // Seed data for CD
        CD::create([
            'judul' => 'Petualangan Dora',
            'tahun_terbit' => 2023,
            'penerbit' => 'Asep',
        ]);
        
        CD::create([
            'judul' => 'Japanese Adorable Video',
            'tahun_terbit' => 2022,
            'penerbit' => 'Yanto',
        ]);

        CD::create([
            'judul' => 'Uttaran Complete Episodes',
            'tahun_terbit' => 2021,
            'penerbit' => 'Dadang',
        ]);

        // Seed data for Newspapers
        Newspaper::create([
            'judul' => 'Pejabat Korupsi, Rakyat Pura - Pura Kaget',
            'tahun_terbit' => 2022,
            'penerbit' => 'TribunBarat',
            'penulis' => 'Jontor',
            'jumlah_halaman' => 8,
        ]);

        Newspaper::create([
            'judul' => 'Lesti Putuskan Lepas Kawat Gigi',
            'tahun_terbit' => 2021,
            'penerbit' => 'Kampas',
            'penulis' => 'John Doe',
            'jumlah_halaman' => 10,
        ]);

        Newspaper::create([
            'judul' => 'Mengaku Tak Punya Beras, Ganjar: "Lha, ini ada nasi goreng"',
            'tahun_terbit' => 2023,
            'penerbit' => 'NigeriaZone',
            'penulis' => 'Yanto',
            'jumlah_halaman' => 9,
        ]);

        // Seed data for Final Year Project
        FinalYearProject::create([
            'judul' => 'Ketika Hati dan Kantong Berkonflik: Pengaruh Hawa Nafsu pada Kasus Korupsi',
            'tahun_terbit' => 2022,
            'penerbit' => 'Kampus',
            'penulis' => 'Tono',
            'jumlah_halaman' => 100,
        ]);

        FinalYearProject::create([
            'judul' => 'Analisis Risk dan Profit dari Ngepet',
            'tahun_terbit' => 2021,
            'penerbit' => 'Kampus',
            'penulis' => 'Asep',
            'jumlah_halaman' => 90,
        ]);

    }
}
