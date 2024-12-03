<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
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
    protected $table = 'pelanggaran';

    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'poin',
        'deskripsi',
    ];
}
