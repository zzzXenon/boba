<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    protected $table = 'pelanggaran';

    protected $fillable = [
        'user_id',
        'list_pelanggaran_id',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listPelanggaran()
    {
        return $this->belongsTo(ListPelanggaran::class, 'list_pelanggaran_id');
    }
}
