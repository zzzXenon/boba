<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function showDashboardOrangtua()
  {
    // Fetch data for Orang Tua role
    // Assuming the role is stored in the 'role' attribute
    $user = User::where('role', 'Orang Tua')->first(); // Fetch the user for Orang Tua role

    // Check if a user with the role exists
    if (!$user) {
      return redirect()->route('home'); // Redirect to a safe place if no user is found
    }

    // Pass data to the Orang Tua dashboard view
    return view('dashboard.orangtua', ['user' => $user]);
  }

  public function showDashboardAdmin()
  {
    // Fetch data with relationships
    $pelanggaran = Pelanggaran::with('user', 'listPelanggaran')->get();

    // Pass the data to the Blade view
    return view('dashboard.admin', compact('pelanggaran'));
  }
}
