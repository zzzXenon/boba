<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelanggaranController;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'Orang Tua') {
            return view('dashboard.orangtua', compact('user'));
        }

        return view('dashboard.admin', compact('user'));
    }
    return redirect()->route('login');
})->name('home');


// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Role-based dashboard routes
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/orangtua', [DashboardController::class, 'showDashboardOrangtua'])->name('dashboard.orangtua');
    Route::get('/dashboard/admin', [DashboardController::class, 'showDashboardAdmin'])->name('dashboard.admin');

    Route::get('/pelanggaran/{id}/comments', [PelanggaranController::class, 'showComments'])->name('pelanggaran.showComments');
    Route::post('/pelanggaran/{id}/comments', [PelanggaranController::class, 'storeComment'])->name('pelanggaran.storeComment');

    Route::get('/detail-mahasiswa', [PelanggaranController::class, 'showPelanggaran'])->name('detailMahasiswa');

    Route::get('/pelanggaran/update', [PelanggaranController::class, 'updatePelanggaran'])->name('updatePelanggaran');
    Route::post('/pelanggaran/update', [PelanggaranController::class, 'updatePelanggaranStatus'])->name('updateStatus');
    Route::post('/pelanggaran/{id}/update-status', [PelanggaranController::class, 'updateStatus'])->name('pelanggaran.update_status');

    Route::prefix('pelanggaran')->group(function () {
        Route::get('/add', [PelanggaranController::class, 'create'])->name('pelanggaran.create');
        Route::post('/add', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
<<<<<<< Updated upstream
        Route::get('/', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
    });
=======
        Route::get('/{id}/comments', [PelanggaranController::class, 'showComments'])->name('pelanggaran.showComments');
        Route::post('/{id}/comments', [PelanggaranController::class, 'storeComment'])->name('pelanggaran.storeComment');
        Route::get('/update', [PelanggaranController::class, 'updatePelanggaran'])->name('updatePelanggaran');
        Route::post('/{id}/update-status', [PelanggaranController::class, 'updateStatus'])->name('pelanggaran.updateStatus');

        Route::post('/{id}/update-level', [PelanggaranController::class, 'updateLevel'])->name('pelanggaran.updateLevel');

        Route::patch('/{pelanggaran}/update-level', [PelanggaranController::class, 'updateLevel'])->name('pelanggaran.updateLevel');
    });


    // Detail Mahasiswa Route
    Route::get('/pelanggaran-mahasiswa', [PelanggaranController::class, 'showPelanggaranMhs'])->name('pelanggaranMahasiswa');
    Route::get('/pelanggaran-mahasiswa/{id}/', [PelanggaranController::class, 'showDetailMahasiswa'])->name('pelanggaranMahasiswa.detail');
>>>>>>> Stashed changes
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
