<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Comment;
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
}
