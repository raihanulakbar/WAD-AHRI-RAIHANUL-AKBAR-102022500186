<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['WiFi', 'Stopkontak', 'Meja'] as $nama) {
            Fasilitas::create(['nama_fasilitas' => $nama, 'keterangan' => 'Tersedia']);
        }
    }
}