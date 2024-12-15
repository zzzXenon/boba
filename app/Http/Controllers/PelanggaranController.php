<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Comment;
use App\Models\User;
use App\Models\ListPelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PelanggaranController extends Controller
{
<<<<<<< Updated upstream
    public function showPelanggaran()
=======
    protected function getPoinPelanggaran()
    {
        if (Auth::user()->role === 'Keasramaan') {
            return ListPelanggaran::where('tingkat', 'LIKE', '%Ringan%')
                ->orWhere('tingkat', 'LIKE', '%Sedang%')
                ->get();
        }

        return ListPelanggaran::all();
    }

    public function create()
    {
        // Use the helper function
        $poinPelanggaran = $this->getPoinPelanggaran();

        // Return the form view
        return view('fitur.addPelanggaran', compact('poinPelanggaran'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'angkatan' => 'required|string',
            'prodi' => 'required|string',
            'nim' => 'required|string',
            'nama' => 'required|string',
            'list_pelanggaran_id' => 'required|exists:list_pelanggaran,id',
        ]);

        // Find the user by their details
        $user = User::where('angkatan', $request->angkatan)
            ->where('prodi', $request->prodi)
            ->where('nim', $request->nim)
            ->where('nama', $request->nama)
            ->first();

        // Check if the user exists and has the correct role
        if (!$user || $user->role !== 'Orang Tua') {
            return redirect()->route('pelanggaran.create')->withErrors([
                'user' => 'Mahasiswa tidak ditemukan!',
            ])->withInput();
        }

        try {
            // Fetch the related 'list_pelanggaran' record
            $listPelanggaran = ListPelanggaran::findOrFail($request->list_pelanggaran_id);

            // Determine the initial 'level' and 'status' based on the 'tingkat' attribute
            $level = null;
            $status = 'Sedang diproses'; // Default status

            if (str_contains($listPelanggaran->tingkat, 'Berat')) {
                $level = 'Level 1'; // Start the process at Level 1 for Pelanggaran Berat
            } elseif (str_contains($listPelanggaran->tingkat, 'Ringan') || str_contains($listPelanggaran->tingkat, 'Sedang')) {
                $level = null;  // Set level to null for Ringan/Sedang Pelanggaran
                $status = 'Selesai'; // Set status to 'Selesai' for Ringan/Sedang Pelanggaran
            }

            // Create the pelanggaran record
            Pelanggaran::create([
                'user_id' => $user->id,
                'list_pelanggaran_id' => $request->list_pelanggaran_id,
                'status' => $status, // Set the status
                'level' => $level, // Set the process level
            ]);

            // Redirect to the dashboard with a success message
            return redirect()->route('dashboard.admin')->with('success', 'Berhasil membuat pelanggaran!');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Gagal membuat pelanggaran: ' . $e->getMessage());

            return redirect()->route('pelanggaran.create')->withErrors([
                'general' => 'ERROR terjadi ketika membuat Pelanggaran baru. Silahkan coba lagi.',
            ])->withInput();
        }
    }

    public function showPelanggaranMhs()
>>>>>>> Stashed changes
    {
        $userId = Auth::id();

        $pelanggaranList = Pelanggaran::where('user_id', $userId)->get();

        return view('fitur.detailMahasiswa', compact('pelanggaranList'));
    }

    public function showComments($id)
    {
        // Fetch the pelanggaran record with related comments, user, and listPelanggaran data
        $pelanggaran = Pelanggaran::with(['user', 'listPelanggaran', 'comments.user'])->findOrFail($id);

<<<<<<< Updated upstream
        // Pass the data to the view
=======
        // Get the level attribute and the currently authenticated user
        $level = $pelanggaran->level;
        $user = Auth::user();

        if ($level == "Level 1" && $user->role !== 'Dosen') {
            abort(403, 'Unauthorized action.');
        }

        if ($level == "Level 2" && $user->role !== 'Kemahasiswaan') {
            abort(403, 'Unauthorized action.');
        }

        if ($level == "Level 3" && $user->role !== 'Komisi Disiplin') {
            abort(403, 'Unauthorized action.');
        }

        if ($level == "Level 4" && $user->role !== 'Rektor') {
            abort(403, 'Unauthorized action.');
        }

>>>>>>> Stashed changes
        return view('fitur.detailPelanggaran', compact('pelanggaran'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Optional file validation
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'public');
        }

        Comment::create([
            'pelanggaran_id' => $pelanggaran->id,
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
            'file_path' => $filePath,
        ]);

<<<<<<< Updated upstream
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
=======
        // Log the action for comment creation
        PelanggaranLog::create([
            'pelanggaran_id' => $pelanggaran->id,
            'user_id' => $request->user()->id,
            'action' => 'New Comment Added',
            'details' => $request->comment,
        ]);

        // Check if the user is 'Dosen' and the current level is 'Level 1'
        if ($request->user()->role === 'Dosen' && $pelanggaran->level === 'Level 1') {
            // Update level to 'Level 2'
            $pelanggaran->level = 'Level 2';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 2 by Dosen Wali',
            ]);
>>>>>>> Stashed changes
        }

        // Check if the user is 'Rektor' and the current level is 'Level 4'
        if ($request->user()->role === 'Rektor' && $pelanggaran->level === 'Level 4') {
            // Update status to 'Selesai'
            $pelanggaran->status = 'Selesai';

            // Log the status update
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Status Updated',
                'details' => 'Status changed to Selesai by Rektor',
            ]);

            // Now update the level using the existing updateLevel method
            $this->updateLevel($request, $pelanggaran); // Calls the updateLevel method to transition to 'Level 5'
        } else {
            // If the action involves level changes like 'Kemahasiswaan' moving to 'Level 3' or 'Level 4'
            if ($request->has('action')) {
                $this->updateLevel($request, $pelanggaran);
            }
        }

        // Save the changes (status and level)
        $pelanggaran->save();

        // Redirect to the admin dashboard after the comment is added and level is updated
        return redirect()->route('dashboard.admin')
            ->with('success', 'Berhasil membuat tanggapan dan mengupdate level!');
    }

    public function updateLevel(Request $request, $pelanggaran)
    {
        // Get the current level of the pelanggaran
        $currentLevel = $pelanggaran->level;

        // Check if the current level is 'Level 1' and handle transition to 'Level 2'
        if ($currentLevel === 'Level 1') {
            $pelanggaran->level = 'Level 2';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 2 by Dosen Wali',
            ]);
        }
        // Check if the current level is 'Level 2' and handle transitions to 'Level 3' or 'Level 4'
        elseif ($currentLevel === 'Level 2') {
            if ($request->action == 'level_3') {
                // Move to Level 3 (Komdis)
                $pelanggaran->level = 'Level 3';
                PelanggaranLog::create([
                    'pelanggaran_id' => $pelanggaran->id,
                    'user_id' => $request->user()->id,
                    'action' => 'Level Updated',
                    'details' => 'Level changed to Level 3 by Kemahasiswaan',
                ]);
            } elseif ($request->action == 'level_4') {
                // Move to Level 4 (Rektor)
                $pelanggaran->level = 'Level 4';
                PelanggaranLog::create([
                    'pelanggaran_id' => $pelanggaran->id,
                    'user_id' => $request->user()->id,
                    'action' => 'Level Updated',
                    'details' => 'Level changed to Level 4 by Kemahasiswaan',
                ]);
            }
            // Check if the current level is 'Level 3' and handle transition to 'Level 4'
        } elseif ($currentLevel === 'Level 3') {
            $pelanggaran->level = 'Level 4';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 4 by Komisi Disiplin',
            ]);
        }
        // Check if the current level is 'Level 4' and handle transition to 'Level 5'
        elseif ($currentLevel === 'Level 4') {
            // Automatically move to Level 5 (Rektor's action)
            $pelanggaran->level = 'Level 5';
            PelanggaranLog::create([
                'pelanggaran_id' => $pelanggaran->id,
                'user_id' => $request->user()->id,
                'action' => 'Level Updated',
                'details' => 'Level changed to Level 5 by Rektor',
            ]);
        }

        // Save the changes
        $pelanggaran->save();
    }

    public function updatePelanggaran()
    {
        $pelanggaranList = Pelanggaran::with('user')->get();

        return view('fitur.detailPelanggaran', compact('pelanggaranList'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->status = $request->input('status');
        $pelanggaran->save();

<<<<<<< Updated upstream
        return back()->with('success', 'Berhasil mengubah status pelanggaran!.');
=======
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
            ]);

            return redirect()->route('pelanggaran.showComments', $id)
                ->with('success', 'Status berhasil diperbarui!');
        }

        return redirect()->route('pelanggaran.showComments', $id)
            ->with('info', 'Tidak ada perubahan status.');
>>>>>>> Stashed changes
    }
}
