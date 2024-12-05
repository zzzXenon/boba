<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUsersRoleAdmin()
    {
        $users = User::select('id', 'name', 'email', 'role')->get();

        // Kirim data ke view
        return view('SIS.Admin.KelolaPengguna', compact('users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string|in:admin,member',
            'password' => 'required|string|min:5',
        ]);

        // Buat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        // Redirect kembali ke halaman kelola pengguna dengan pesan sukses
        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::find($id);

        // Jika user tidak ditemukan, kembalikan respons error
        if (!$user) {
            return redirect()->route('kelola.pengguna')->with('error', 'Pengguna tidak ditemukan.');
        // Fetch user data based on ID
        $student = User::where('id', $id)
            ->select('nama as name', 'angkatan', 'nim', 'username', 'email', 'kelas', 'prodi', 'wali')
            ->first();

        // If student not found, redirect with error message
        if (!$student) {
            return redirect()->back()->with('error', 'Data Mahasiswa tidak ditemukan.');
        }

        // Hapus user
        $user->delete();

        // Redirect kembali ke halaman kelola pengguna dengan pesan sukses
        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|in:admin,member',
            'password' => 'nullable|string|min:5',
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika kata sandi diisi, update juga
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('kelola.pengguna')->with('success', 'Data pengguna berhasil diperbarui.');
        // Pass data to the view
        return view('infoMahasiswa', compact('student'));
    }
}
