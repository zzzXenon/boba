<?php

namespace App\Models;

<<<<<<< Updated upstream
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> Stashed changes
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
<<<<<<< Updated upstream
    use HasFactory;

    // Tentukan nama tabel yang sesuai dengan yang ada di database
    protected $table = 'pelanggaran'; 

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'angkatan', 
        'prodi', 
        'nim', 
        'nama', 
        'detail_pelanggaran'
=======
    protected $table = 'pelanggaran';

    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'poin',
        'deskripsi',
>>>>>>> Stashed changes
    ];
}
