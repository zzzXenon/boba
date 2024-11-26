<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ViolationController;

// Rute untuk halaman utama (opsional, jika diperlukan)
Route::get('/', function () {
    return redirect('/parent/informationPage'); // Redirect ke halaman profil
});

// Rute untuk halaman informasi mahasiswa
Route::get('/parent/informationPage', [StudentController::class, 'showProfile']);

Route::get('/parent/pelanggaranPage', [ViolationController::class, 'index']);
