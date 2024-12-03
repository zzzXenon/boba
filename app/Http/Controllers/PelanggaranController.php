<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\PoinPelanggaran; // Pastikan Anda mengimport model PoinPelanggaran
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    // Menampilkan daftar pelanggaran
    public function index()
    {
        $pelanggarans = Pelanggaran::all(); // Ambil semua data pelanggaran
        return view('pelanggaran.index', compact('pelanggarans'));
    }

    // Menampilkan form untuk menambah pelanggaran baru
    public function create()
    {
        // Ambil data unik untuk angkatan, prodi, nim, dan nama dari tabel pelanggaran
        $angkatans = Pelanggaran::distinct()->pluck('angkatan');
        $prodis = Pelanggaran::distinct()->pluck('prodi');
        $nims = Pelanggaran::distinct()->pluck('nim');
        $names = Pelanggaran::distinct()->pluck('nama');

        // Mengambil semua data jenis pelanggaran (poin pelanggaran)
        $poinPelanggaran = PoinPelanggaran::all();  // Semua jenis pelanggaran

        // Kirim data ke view
        return view('pelanggaran.create', compact('angkatans', 'prodis', 'nims', 'names', 'poinPelanggaran'));
    }

    // Menyediakan data mahasiswa berdasarkan angkatan dan prodi
    public function getMahasiswa(Request $request)
    {
        // Ambil data angkatan dan prodi dari request
        $angkatan = $request->query('angkatan');
        $prodi = $request->query('prodi');

        // Ambil data mahasiswa berdasarkan angkatan dan prodi
        $mahasiswa = Pelanggaran::where('angkatan', $angkatan)
            ->where('prodi', $prodi)
            ->get(['nim', 'nama']); // Mengambil NIM dan Nama saja

        // Mengembalikan data mahasiswa dalam format JSON
        return response()->json($mahasiswa);
    }

    // Menyediakan data jenis pelanggaran (poin pelanggaran)
    public function getPelanggaran()
    {
        // Ambil semua data poin pelanggaran dari tabel poin_pelanggaran
        $pelanggarans = PoinPelanggaran::all();

        // Mengembalikan data pelanggaran dalam format JSON
        return response()->json($pelanggarans);
    }

    // Menyimpan data pelanggaran baru yang dikirimkan dari form
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'angkatan' => 'required',
            'prodi' => 'required',
            'nim' => 'required',
            'nama' => 'required',
            'poin_pelanggaran' => 'required', // Pastikan poin pelanggaran ada
        ]);

        // Ambil detail pelanggaran dari tabel poin_pelanggaran berdasarkan poin_pelanggaran ID yang dipilih
        $poinPelanggaran = PoinPelanggaran::find($request->poin_pelanggaran);

        // Simpan data pelanggaran baru ke database
        Pelanggaran::create([
            'angkatan' => $request->angkatan,
            'prodi' => $request->prodi,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'detail_pelanggaran' => $poinPelanggaran ? $poinPelanggaran->nama_pelanggaran : 'Detail Pelanggaran Tidak Ditemukan',
            'poin_pelanggaran' => $request->poin_pelanggaran,  // Menyimpan poin pelanggaran
        ]);

        // Redirect ke halaman daftar pelanggaran atau halaman sukses
        return redirect()->route('pelanggaran.index')->with('success', 'Data pelanggaran berhasil disimpan');
    }
}
