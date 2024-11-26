<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Violation; // Impor model di sini

class ViolationController extends Controller
{
    public function index()
    {
        // Ambil semua data pelanggaran dari database
        $violations = Violation::all();

        // Kirim data ke view
        return view('parent.pelanggaranPage', compact('violations'));
    }
}
