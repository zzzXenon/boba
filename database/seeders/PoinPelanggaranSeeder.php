<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoinPelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data pelanggaran dan poin
        $pelanggaran = [
            ['nama_pelanggaran' => 'Terlambat Masuk Kelas', 'poin' => 3],
            ['nama_pelanggaran' => 'Menyontek Ujian', 'poin' => 12],
            ['nama_pelanggaran' => 'Merokok di Area Kampus', 'poin' => 7],
            ['nama_pelanggaran' => 'Membuang Sampah Sembarangan', 'poin' => 2],
            ['nama_pelanggaran' => 'Menyalahgunakan Fasilitas Kampus', 'poin' => 25],
        ];

        foreach ($pelanggaran as $item) {
            // Tentukan tingkat berdasarkan poin
            $tingkat = $this->getTingkat($item['poin']);

            DB::table('poin_pelanggaran')->insert([
                'nama_pelanggaran' => $item['nama_pelanggaran'],
                'poin' => $item['poin'],
                'tingkat' => $tingkat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Menentukan tingkat berdasarkan poin
     *
     * @param int $poin
     * @return string
     */
    private function getTingkat($poin)
    {
        if ($poin >= 1 && $poin <= 5) {
            return 'Ringan Level 1';
        } elseif ($poin >= 6 && $poin <= 10) {
            return 'Ringan Level 2';
        } elseif ($poin >= 11 && $poin <= 15) {
            return 'Sedang Level 1';
        } elseif ($poin >= 16 && $poin <= 24) {
            return 'Sedang Level 2';
        } elseif ($poin >= 25 && $poin <= 30) {
            return 'Berat Level 1';
        } elseif ($poin >= 31 && $poin <= 75) {
            return 'Berat Level 2';
        } else {
            return 'Berat Level 3';
        }
    }
}
