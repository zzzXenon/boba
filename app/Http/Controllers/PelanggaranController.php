<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Comment;
use App\Models\User;
use App\Models\ListPelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function showComments($id)
    {
        // Fetch the pelanggaran record with related user and listPelanggaran data
        $pelanggaran = Pelanggaran::with(['user', 'listPelanggaran'])->findOrFail($id);

        // Pass the data to the view
        return view('fitur.detailPelanggaran', compact('pelanggaran'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);

        Comment::create([
            'pelanggaran_id' => $pelanggaran->id,
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('pelanggaran.showComments', $pelanggaran->id)
            ->with('success', 'Comment added successfully!');
    }

    //////////////////////////////////////////////////////////////////////////////////////

    // Display the form to add Pelanggaran
    public function create()
    {
        // Retrieve unique Angkatan
        $angkatans = User::select('angkatan')->distinct()->get();

        // Retrieve ListPelanggaran data
        $poinPelanggaran = ListPelanggaran::all();

        // Pass data to the view
        return view('fitur.addPelanggaran', compact('angkatans', 'poinPelanggaran'));
    }

    // Get Prodi based on selected Angkatan
    public function getProdiByAngkatan($angkatan)
    {
        $prodis = User::where('angkatan', $angkatan)->pluck('prodi', 'prodi');
        return response()->json($prodis);
    }

    // Get NIM and Nama based on selected Prodi
    public function getNimNamaByProdi($prodi)
    {
        $mahasiswa = User::where('prodi', $prodi)->get(['nim', 'nama']);
        return response()->json($mahasiswa);
    }

    // Store Pelanggaran data
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'angkatan' => 'required',
            'prodi' => 'required',
            'nim' => 'required',
            'nama' => 'required',
            'poin_pelanggaran' => 'required', // Ensure the correct field is validated
        ]);

        // Find the mahasiswa based on NIM
        $mahasiswa = User::where('nim', $request->nim)->firstOrFail();

        // Create a new Pelanggaran record
        Pelanggaran::create([
            'user_id' => $mahasiswa->id,
            'list_pelanggaran_id' => $request->poin_pelanggaran,
            'status' => 'Belum Diperiksa', // Default status
        ]);

        // Redirect back with a success message
        return redirect()->route('pelanggaran.create')->with('success', 'Pelanggaran berhasil ditambahkan.');
    }
}
