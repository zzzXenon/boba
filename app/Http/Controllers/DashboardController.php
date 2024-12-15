<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
  public function showDashboardOrangtua()
  {
    if (Gate::denies('access-ortu')) {
      abort(403, 'Unauthorized action.');
    }

    $user = Auth::user();

    // Check if a user with the role exists
    if (!$user) {
      return redirect()->route('home');
    }

    // Pass data to the Orang Tua dashboard view
    return view('dashboard.orangtua', ['user' => $user]);
  }

  public function showDashboardAdmin()
  {
    if (Gate::denies('access-admin')) {
      abort(403, 'Unauthorized action.');
    }

    $user = Auth::user();
    $pelanggaranQuery = Pelanggaran::with('user', 'listPelanggaran');

    // Filter pelanggaran data based on roles
    if ($user->role === 'Dosen') {
      // Dosen Wali: Only see pelanggaran assigned to students where 'wali' matches the Dosen's name
      $pelanggaran = $pelanggaranQuery->whereHas('user', function ($query) use ($user) {
        $query->where('wali', $user->nama);
      })->get();
    } elseif ($user->role === 'Komisi Disiplin') {
      // Komisi Disiplin: Only see Level 3
      $pelanggaran = $pelanggaranQuery->where('level', 'Level 3')->get();
    } elseif ($user->role === 'Rektor') {
      // Rektor: See both Level 4 and Level 5
      $pelanggaran = $pelanggaranQuery->where(function ($query) {
        $query->where('level', 'Level 4')
          ->orWhere('level', 'Level 5');
      })->get();
    } elseif ($user->role === 'Kemahasiswaan' || $user->role === 'Keasramaan') {
      // Kemahasiswaan & Keasramaan: View all pelanggaran
      $pelanggaran = $pelanggaranQuery->get();
    } else {
      // Default empty if role doesn't match
      $pelanggaran = collect();
    }

    return view('dashboard.admin', compact('pelanggaran'));
  }
}
