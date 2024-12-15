<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        if (!$user) {
            // Jika pengguna belum login, redirect ke halaman login atau tampilkan pesan error
            return redirect()->route('login');
        }
        if ($user->role === 'Orang Tua') {
            return redirect()->route('dashboard.orangtua');
        }

        return redirect()->route('dashboard.admin');
    }

    public function showDashboardOrangtua()
    {
        if (Gate::denies('access-ortu')) {
            abort(403, 'Unauthorized action.');
        }
    
        $user = Auth::user();
    
        // Cek apakah pengguna ada
        if (!$user) {
            return redirect()->route('home');
        }
    
        // Ambil data pelanggaran yang diurutkan berdasarkan created_at secara descending dan paginated
        $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('wali', $user->nama);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 item per halaman
    
        // Pass data ke view dengan benar
        return view('dashboard.orangtua', compact('pelanggaran', 'user'));
    }
    

    public function showDashboardAdmin()
    {
        if (Gate::denies('access-admin')) {
            abort(403, 'Unauthorized action.');
        }
    
        $user = Auth::user();
    
        // Fetch pelanggaran data based on role
        if (in_array($user->role, ['Keasramaan', 'Kemahasiswaan'])) {
            $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
                ->orderBy('created_at', 'desc') 
                ->paginate(10);
        } elseif (in_array($user->role, ['Komisi Disiplin', 'Rektor'])) {
            $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
                ->whereHas('listPelanggaran', function ($query) {
                    $query->where('poin', '>', 25);
                })
                ->orderBy('created_at', 'desc') 
                ->paginate(10);
        } elseif ($user->role === 'Dosen') {
            $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
                ->whereHas('user', function ($query) use ($user) {
                    $query->where('wali', $user->nama);
                })
                ->orderBy('created_at', 'desc') 
                ->paginate(10);
        } else {
            // Default: admin memiliki akses ke semua pelanggaran
            $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
                ->orderBy('created_at', 'desc') 
                ->paginate(10);
        }
    
        // Pass data ke view dengan benar
        return view('dashboard.admin', compact('pelanggaran'));
    }
    

    public function search(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|in:nama,nim,status',
            'search' => 'required|string',
        ]);
    
        $kategori = $request->input('kategori');
        $search = $request->input('search');
    
        $user = Auth::user();
    
        $query = Pelanggaran::with('user', 'listPelanggaran');
    
        // Terapkan filter berdasarkan role
        if ($user->role === 'Orang Tua') {
            $query->whereHas('user', function ($q) use ($user) {
                $q->where('wali', $user->nama);
            });
        }
    
        switch ($kategori) {
            case 'nama':
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
                break;
            case 'nim':
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('nim', 'like', "%{$search}%");
                });
                break;
            case 'status':
                $query->where('status', 'like', "%{$search}%");
                break;
            // Tambahkan kategori lain jika diperlukan
        }
    
        $pelanggaran = $query->orderBy('created_at', 'desc')->paginate(10);
    
        // Tentukan view berdasarkan role
        if ($user->role === 'Orang Tua') {
            return view('dashboard.orangtua', compact('pelanggaran', 'user'));
        } else {
            return view('dashboard.admin', compact('pelanggaran'));
        }
    }
    
}
