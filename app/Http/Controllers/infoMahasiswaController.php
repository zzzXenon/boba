<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class infoMahasiswaController extends Controller
{
    public function getDashboardData()
    {
        // Hitung jumlah pengguna selama 7 hari terakhir
        $userCounts = [];
        $dates = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $userCounts[] = User::whereDate('created_at', $date->toDateString())->count();
            $dates[] = $date->format('d M');
        }

        // Kirim data ke view
        return view('view-1.infoMahasiswa', [
            'userCounts' => $userCounts,
            'dates' => $dates,
        ]);
    }
}
