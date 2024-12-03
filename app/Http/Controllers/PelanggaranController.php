<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
    $pelanggarans = Pelanggaran::all(); // Ambil semua data pelanggaran
    return view('pelanggaran.index', compact('pelanggarans'));
    }

    // Menampilkan form create
    public function create()
    {
        // Ambil data unik untuk angkatan, prodi, nim, dan nama
        $angkatans = Pelanggaran::distinct()->pluck('angkatan');
        $prodis = Pelanggaran::distinct()->pluck('prodi');
        $nims = Pelanggaran::distinct()->pluck('nim');
        $names = Pelanggaran::distinct()->pluck('nama');
        
        // Kirim data ke view
        return view('pelanggaran.create', compact('angkatans', 'prodis', 'nims', 'names'));
    }
    public function getMahasiswa(Request $request)
    {
        // Ambil data angkatan dan prodi dari request
        $angkatan = $request->query('angkatan');
        $prodi = $request->query('prodi');

        // Ambil data mahasiswa berdasarkan angkatan dan prodi
        $mahasiswa = Pelanggaran::where('angkatan', $angkatan)
            ->where('prodi', $prodi)
            ->get(['nim', 'nama']);

        // Kembalikan data mahasiswa sebagai JSON
        return response()->json($mahasiswa);
    }
    // Menyimpan data pelanggaran yang dikirimkan dari form
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'angkatan' => 'required',
            'prodi' => 'required',
            'nim' => 'required',
            'nama' => 'required',
            'detail_pelanggaran' => 'required',
        ]);

        // Simpan data pelanggaran baru
        Pelanggaran::create([
            'angkatan' => $request->angkatan,
            'prodi' => $request->prodi,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'detail_pelanggaran' => $request->detail_pelanggaran,
        ]);

        // Redirect ke halaman daftar pelanggaran atau halaman sukses
        return redirect()->route('pelanggaran.index')->with('success', 'Data pelanggaran berhasil disimpan');
    }
}
