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
    public function create()
    {
        // Fetch data for dropdowns or other needs, if necessary
        $poinPelanggaran = ListPelanggaran::all();

        // Return the form view
        return view('fitur.addPelanggaran', compact('poinPelanggaran'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'angkatan' => 'required|string',
            'prodi' => 'required|string',
            'nim' => 'required|string',
            'nama' => 'required|string',
            'list_pelanggaran_id' => 'required|exists:list_pelanggarans,id',
        ]);

        // Check if user exists with the given details
        $user = User::where('angkatan', $request->angkatan)
            ->where('prodi', $request->prodi)
            ->where('nim', $request->nim)
            ->where('nama', $request->nama)
            ->first();

        // If user does not exist or role is not 'Orang Tua', abort the operation
        if (!$user || $user->role !== 'Orang Tua') {
            return redirect()->back()->withErrors([
                'user' => 'User not found or not authorized (Role must be "Orang Tua").',
            ]);
        }

        // Create the pelanggaran record
        Pelanggaran::create([
            'user_id' => $user->id,
            'list_pelanggaran_id' => $request->list_pelanggaran_id,
            'status' => 'pending', // Default status, modify if needed
        ]);

        // Redirect with success message
        return redirect()->route('pelanggaran.index')->with('success', 'Pelanggaran successfully added.');
    }
}
