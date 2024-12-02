<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    StudentController,
    ViolationController,
    PelanggaranController
};

// cek role
// Route::prefix('SIS/Admin')->middleware(['check.roles:admin'])->group(function () {
//     Route::get('/KelolaPengguna', [UserController::class, 'getUsersRoleAdmin'])->name('kelola.pengguna');
// });

Route::resource('users', UserController::class);

Route::get('/', function () {
    return view('loginMain');
})->name('home');

// Rute untuk halaman informasi mahasiswa
Route::get('/parent/informationPage', [StudentController::class, 'showProfile']);

Route::get('/parent/pelanggaranPage', [ViolationController::class, 'index']);

Route::get('/pelanggaran/create', [PelanggaranController::class, 'create'])->name('pelanggaran.create');
Route::post('/pelanggaran/store', [PelanggaranController::class, 'store'])->name('pelanggaran.store');

// Main login page
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Role-specific login pages
Route::get('/login/orangTua', [AuthController::class, 'showOrangTuaLoginForm'])->name('login.Ortu');
Route::get('/login/keasramaan', [AuthController::class, 'showKeasramaanLoginForm'])->name('login.keasramaan');
Route::get('/login/kemahasiswaan', [AuthController::class, 'showKemahasiswaanLoginForm'])->name('login.kemahasiswaan');
Route::get('/login/dosen', [AuthController::class, 'showDosenLoginForm'])->name('login.dosen');

// Handle login
Route::post('/login', [AuthController::class, 'login'])->name('process.login');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
