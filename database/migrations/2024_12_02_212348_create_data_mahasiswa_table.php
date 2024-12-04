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
        Schema::create('data_mahasiswa', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama'); // Kolom 'nama' bertipe string
            $table->year('angkatan'); // Kolom 'angkatan' bertipe year (tahun)
            $table->string('nim', 8)->unique(); // Kolom 'nim' dengan panjang maksimal 8 karakter
            $table->string('username')->unique(); // Kolom 'username' bertipe string dan unik
            $table->string('email')->unique(); // Kolom 'email' bertipe string dan unik
            $table->string('kelas'); // Kolom 'kelas' bertipe string
            $table->string('prodi'); // Kolom 'prodi' bertipe string
            $table->string('walikelas'); // Kolom 'walikelas' bertipe string
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_mahasiswa');
    }
};
