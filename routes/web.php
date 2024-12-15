<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelanggaranController;

// Public Routes
Route::get('/', [DashboardController::class, 'home'])->name('home');

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {

    // Dashboard Routes
    Route::get('/dashboard/orangtua', [DashboardController::class, 'showDashboardOrangtua'])->name('dashboard.orangtua');
    Route::get('/dashboard/admin', [DashboardController::class, 'showDashboardAdmin'])->name('dashboard.admin');

    // Pelanggaran Routes
    Route::prefix('pelanggaran')->group(function () {
        Route::get('/', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
        Route::get('/add', [PelanggaranController::class, 'create'])->name('pelanggaran.create');
        Route::post('/add', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
        Route::get('/{id}/comments', [PelanggaranController::class, 'showComments'])->name('pelanggaran.showComments');
        Route::post('/{id}/comments', [PelanggaranController::class, 'storeComment'])->name('pelanggaran.storeComment');
        Route::get('/update', [PelanggaranController::class, 'updatePelanggaran'])->name('updatePelanggaran');
        Route::post('/{id}/update-status', [PelanggaranController::class, 'updateStatus'])->name('pelanggaran.updateStatus');

        // Tambahkan route pencarian
        Route::get('/search', [DashboardController::class, 'search'])->name('pelanggaran.search');
    });

    // Detail Mahasiswa Route
    Route::get('/pelanggaran-mahasiswa', [PelanggaranController::class, 'showPelanggaranMhs'])->name('pelanggaranMahasiswa');
    Route::get('/pelanggaran-mahasiswa/{id}/', [PelanggaranController::class, 'showDetailMahasiswa'])->name('pelanggaranMahasiswa.detail');
});



// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard/orangtua', [DashboardController::class, 'showDashboardOrangtua'])->name('dashboard.orangtua');
//     Route::get('/dashboard/admin', [DashboardController::class, 'showDashboardAdmin'])->name('dashboard.admin');
// });

// Route::get('/pelanggaran/{id}/comments', [PelanggaranController::class, 'showComments'])->name('pelanggaran.showComments');
// Route::post('/pelanggaran/{id}/comments', [PelanggaranController::class, 'storeComment'])->name('pelanggaran.storeComment');

// Route::prefix('pelanggaran')->group(function () {
//     Route::get('/add', [PelanggaranController::class, 'create'])->name('pelanggaran.create'); // GET for the form
//     Route::post('/add', [PelanggaranController::class, 'store'])->name('pelanggaran.store'); // POST for form submission
//     Route::get('/', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
// });
