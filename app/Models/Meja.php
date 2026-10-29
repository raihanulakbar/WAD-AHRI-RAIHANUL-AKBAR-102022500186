<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    // Nama tabel ditulis manual supaya tidak jadi "mejas"
    protected $table = 'meja';

    protected $fillable = [
        'nama_meja',
        'lantai',
        'wifi',
        'stopkontak',
        'status',
        'gambar',
    ];
}