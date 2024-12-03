<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Angkatan dan Prodi yang akan diinput
        $angkatanProdi = [
            ['angkatan' => '2019', 'prodi' => 'Informatika', 'nim_prefix' => '11S'],
            ['angkatan' => '2020', 'prodi' => 'Informatika', 'nim_prefix' => '11S'],
            ['angkatan' => '2021', 'prodi' => 'Informatika', 'nim_prefix' => '11S'],
            ['angkatan' => '2022', 'prodi' => 'Informatika', 'nim_prefix' => '11S'],
            ['angkatan' => '2023', 'prodi' => 'Informatika', 'nim_prefix' => '11S'],
            ['angkatan' => '2024', 'prodi' => 'Informatika', 'nim_prefix' => '11S'],

            ['angkatan' => '2019', 'prodi' => 'Sistem Informasi', 'nim_prefix' => '12S'],
            ['angkatan' => '2020', 'prodi' => 'Sistem Informasi', 'nim_prefix' => '12S'],
            ['angkatan' => '2021', 'prodi' => 'Sistem Informasi', 'nim_prefix' => '12S'],
            ['angkatan' => '2022', 'prodi' => 'Sistem Informasi', 'nim_prefix' => '12S'],
            ['angkatan' => '2023', 'prodi' => 'Sistem Informasi', 'nim_prefix' => '12S'],
            ['angkatan' => '2024', 'prodi' => 'Sistem Informasi', 'nim_prefix' => '12S'],

            ['angkatan' => '2019', 'prodi' => 'Teknik Elektro', 'nim_prefix' => '14S'],
            ['angkatan' => '2020', 'prodi' => 'Teknik Elektro', 'nim_prefix' => '14S'],
            ['angkatan' => '2021', 'prodi' => 'Teknik Elektro', 'nim_prefix' => '14S'],
            ['angkatan' => '2022', 'prodi' => 'Teknik Elektro', 'nim_prefix' => '14S'],
            ['angkatan' => '2023', 'prodi' => 'Teknik Elektro', 'nim_prefix' => '14S'],
            ['angkatan' => '2024', 'prodi' => 'Teknik Elektro', 'nim_prefix' => '14S'],
        ];

        foreach ($angkatanProdi as $data) {
            for ($i = 1; $i <= 10; $i++) {
                DB::table('pelanggaran')->insert([
                    'angkatan' => $data['angkatan'],
                    'prodi' => $data['prodi'],
                    // Membuat NIM dengan format 'prefix' + 'tahun_angkatan' + 'nomor_urut'
                    'nim' => $data['nim_prefix'] . substr($data['angkatan'], -2) . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'nama' => $faker->name,
                    'detail_pelanggaran' => null,  // Menghapus deskripsi pelanggaran, karena nanti diisi melalui form
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
class PelanggaranSeeder extends Seeder
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
