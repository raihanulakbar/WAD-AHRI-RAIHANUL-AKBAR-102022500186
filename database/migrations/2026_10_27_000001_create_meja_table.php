<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_meja', 50);
            $table->unsignedTinyInteger('lantai');
            $table->enum('wifi', ['Ya', 'Tidak'])->default('Ya');
            $table->enum('stopkontak', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('status', ['Tersedia', 'Digunakan'])->default('Tersedia');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meja');
    }
};