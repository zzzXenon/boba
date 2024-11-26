<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViolationSeeder extends Seeder
{
    public function run()
    {
        DB::table('violations')->insert([
            [
                'description' => 'Mencuri Laptop yang bukan miliknya',
                'points' => 75,
                'status' => 'kasus sedang diproses oleh kemahasiswaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Bermesraan dengan lawan jenis',
                'points' => 50,
                'status' => 'Kasus Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
