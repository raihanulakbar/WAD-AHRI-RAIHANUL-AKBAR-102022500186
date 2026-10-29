<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Meja 01', 1, 'Ya', 'Tidak', 'Tersedia',  'download.jpg'],
            ['Meja 02', 1, 'Ya', 'Ya',    'Digunakan', 'Shared Library Computer Tables that Offer Personal Space.jpg'],
            ['Meja 03', 2, 'Ya', 'Tidak', 'Tersedia',  'meja.jpg'],
            ['Meja 04', 2, 'Ya', 'Ya',    'Tersedia',  'Perpustakaan Kabupaten Pinrang.jpg'],
        ];

        foreach ($data as [$nama, $lantai, $wifi, $stop, $status, $gambar]) {
            Meja::create([
                'nama_meja'  => $nama,
                'lantai'     => $lantai,
                'wifi'       => $wifi,
                'stopkontak' => $stop,
                'status'     => $status,
                'gambar'     => $gambar,
            ]);
        }
    }
}