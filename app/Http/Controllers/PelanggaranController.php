<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\PoinPelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    // Menampilkan daftar pelanggaran
    public function index()
    {
        $pelanggarans = Pelanggaran::all(); // Ambil semua data pelanggaran
        return view('Fitur.index', compact('pelanggarans'));
    }

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
        return view('Fitur.addPelanggaran', compact('angkatans', 'prodis', 'nims', 'names', 'poinPelanggaran'));
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

        // Simpan data pelanggaran baru ke tabel pelanggaran
        Pelanggaran::create([
            'angkatan' => $request->angkatan,
            'prodi' => $request->prodi,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'poin_pelanggaran_id' => $request->poin_pelanggaran,
            'poin' => $poinPelanggaran ? $poinPelanggaran->poin : 0,  // Menyimpan poin pelanggaran
            'tingkat' => $poinPelanggaran ? $poinPelanggaran->tingkat : 'Tidak Diketahui',  // Menyimpan tingkat pelanggaran
        ]);

        // Redirect ke halaman daftar pelanggaran atau halaman sukses
        return redirect()->route('Fitur.index')->with('success', 'Data pelanggaran berhasil disimpan');
    }
}