<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\PoinPelanggaran; // Pastikan Anda mengimport model PoinPelanggaran
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelanggaranController extends Controller
{
    public function create()
    {
        // Example data for dropdowns (replace with DB queries if needed)
        $angkatans = ['2020', '2021', '2022', '2023'];
        $prodis = ['Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Teknik Industri'];
        $nims = ['12345678', '87654321', '11223344']; // Replace with actual data
        $names = ['Mario Agustin', 'Sijabat Siregar', 'Agustin Silalahi']; // Replace with actual data

        return view('pelanggaran.create', compact('angkatans', 'prodis', 'nims', 'names'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'angkatan' => 'required',
            'prodi' => 'required',
            'nim' => 'required',
            'nama' => 'required',
            'detail_pelanggaran' => 'required|string|max:255',
        ]);

        // Store to database (example code, modify as needed)
        DB::table('pelanggaran')->insert($validated);

        return redirect()->back()->with('success', 'Data Pelanggaran berhasil disimpan!');
    }
}
