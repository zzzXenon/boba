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

    // Fetch pelanggaran data based on role
    if ($user->role === 'Orang Tua') {
      $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
        ->whereHas('user', function ($query) use ($user) {
          $query->where('wali', $user->nama);
        })
        ->get();
    } elseif (in_array($user->role, ['Keasramaan', 'Kemahasiswaan'])) {
      $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')->get();
    } elseif (in_array($user->role, ['Komisi Disiplin', 'Rektor'])) {
      $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
        ->whereHas('listPelanggaran', function ($query) {
          $query->where('poin', '>', 25);
        })
        ->get();
    } elseif ($user->role === 'Dosen') {
      $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')
        ->whereHas('user', function ($query) use ($user) {
          $query->where('wali', $user->nama);
        })
        ->get();
    }

    return view('dashboard.admin', compact('pelanggaran'));
  }
}
