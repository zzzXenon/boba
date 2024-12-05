<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPelanggaranMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pelanggaran_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggaran_id'); // Foreign Key ke tabel pelanggaran
            $table->string('status'); // Status perkembangan
            $table->text('catatan')->nullable(); // Catatan
            $table->string('surat_keputusan')->nullable(); // Kolom untuk menyimpan file surat keputusan (optional)
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('pelanggaran_id')->references('id')->on('pelanggaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pelanggaran_mahasiswa');
    }
}
