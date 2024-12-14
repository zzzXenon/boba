<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use App\Models\PelanggaranLog;
use App\Models\ListPelanggaran;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PelanggaranController extends Controller
{
    public function showPelanggaranMhs()
    {
        $userId = Auth::id();

        $pelanggaranList = Pelanggaran::where('user_id', $userId)->get();

        return view('fitur.pelanggaranMahasiswa', compact('pelanggaranList'));
    }

    public function showDetailMahasiswa($id)
    {
        // Retrieve the pelanggaran record by its ID
        $pelanggaran = Pelanggaran::findOrFail($id);

        // Fetch logs with user data
        $pelanggaranLogs = PelanggaranLog::where('pelanggaran_id', $id)
            ->join('users', 'pelanggaran_logs.user_id', '=', 'users.id')
            ->select(
                'pelanggaran_logs.*',
                'users.nama as user_nama',
                'users.role as user_role'
            )
            ->orderBy('pelanggaran_logs.created_at', 'desc')
            ->get();

        return view('fitur.detailMahasiswa', [
            'pelanggaran' => $pelanggaran,
            'pelanggaranLogs' => $pelanggaranLogs
        ]);
    }

    public function showComments($id)
    {
        // Fetch the pelanggaran record with related comments, user, and listPelanggaran data
        $pelanggaran = Pelanggaran::with(['user', 'listPelanggaran', 'comments.user'])->findOrFail($id);

        return view('fitur.detailPelanggaran', compact('pelanggaran'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Optional file validation
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'public');
        }

        // Create the comment
        $comment = Comment::create([
            'pelanggaran_id' => $pelanggaran->id,
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
            'file_path' => $filePath,
        ]);

        // Log the action
        PelanggaranLog::create([
            'pelanggaran_id' => $pelanggaran->id,
            'user_id' => $request->user()->id,
            'action' => 'New Comment Added',
            'details' => $request->comment,
        ]);


        return redirect()->route('pelanggaran.showComments', $pelanggaran->id)
            ->with('success', 'Berhasil membuat tanggapan!');
    }


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
        $validatedData = $request->validate([
            'angkatan' => 'required|string',
            'prodi' => 'required|string',
            'nim' => 'required|string',
            'nama' => 'required|string',
            'list_pelanggaran_id' => 'required|exists:list_pelanggaran,id',
        ]);

        // Attempt to find the user
        $user = User::where('angkatan', $request->angkatan)
            ->where('prodi', $request->prodi)
            ->where('nim', $request->nim)
            ->where('nama', $request->nama)
            ->first();

        // Check if the user exists and has the correct role
        if (!$user || $user->role !== 'Orang Tua') {
            // Redirect back with error messages
            return redirect()->route('pelanggaran.create')->withErrors([
                'user' => 'Mahasiswa tidak ditemukan!',
            ])->withInput();
        }

        try {
            // Create the pelanggaran record
            Pelanggaran::create([
                'user_id' => $user->id,
                'list_pelanggaran_id' => $request->list_pelanggaran_id,
                'status' => 'Belum Diperiksa',
            ]);

            // Redirect to the dashboard with a success message
            return redirect()->route('dashboard.admin')->with('success', 'Berhasil membuat pelanggaran!');
        } catch (\Exception $e) {
            // Log the exception and redirect back with an error message
            Log::error('Gagal membuat pelanggaran: ' . $e->getMessage());

            return redirect()->route('pelanggaran.create')->withErrors([
                'general' => 'ERROR terjadi ketika membuat Pelanggaran baru. Silahkan coba lagi..',
            ])->withInput();
        }
    }

    public function updatePelanggaran()
    {
        $pelanggaranList = Pelanggaran::with('user')->get();

        return view('fitur.detailPelanggaran', compact('pelanggaranList'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);

        // Check if the status has changed
        if ($pelanggaran->status !== $request->status) {
            $oldStatus = $pelanggaran->status;
            $pelanggaran->status = $request->status;
            $pelanggaran->save();

            // Log the action
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Update Status',
                'details' => "{$request->status}",
                // 'details' => "Status changed from '$oldStatus' to '{$request->status}'",
            ]);

            return redirect()->route('pelanggaran.showComments', $id)
                ->with('success', 'Status berhasil diperbarui!');
        }

        return redirect()->route('pelanggaran.showComments', $id)
            ->with('info', 'Tidak ada perubahan status.');
    }
}
