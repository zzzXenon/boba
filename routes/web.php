<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\PelanggaranController;

// Rute untuk halaman utama (opsional, jika diperlukan)
Route::get('/', function () {
    return view('loginMain');
})->name('home');

// Rute untuk halaman informasi mahasiswa
Route::get('/parent/informationPage', [StudentController::class, 'showProfile']);

Route::get('/parent/pelanggaranPage', [ViolationController::class, 'index']);

Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
Route::get('/pelanggaran/create', [PelanggaranController::class, 'create'])->name('pelanggaran.create');
Route::post('/pelanggaran/store', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
