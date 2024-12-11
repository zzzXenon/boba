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

    // Fetch data with relationships
    $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')->get();

    // Pass the data to the Blade view
    return view('dashboard.admin', compact('pelanggaran'));
  }
}
