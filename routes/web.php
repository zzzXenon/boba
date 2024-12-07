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
    Route::get('/dashboard/orangtua', function () {
        return view('dashboard.orangtua');
    })->name('dashboard.orangtua');

    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->name('dashboard.admin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/orangtua', [DashboardController::class, 'showDashboardOrangtua'])->name('dashboard.orangtua');
    Route::get('/dashboard/admin', [DashboardController::class, 'showDashboardAdmin'])->name('dashboard.admin');
});

Route::get('/pelanggaran/{id}/comments', [PelanggaranController::class, 'showComments'])->name('pelanggaran.showComments');
Route::post('/pelanggaran/{id}/comments', [PelanggaranController::class, 'storeComment'])->name('comments.store');

Route::prefix('pelanggaran')->group(function () {
    Route::get('/add', [PelanggaranController::class, 'create'])->name('pelanggaran.create'); // GET for the form
    Route::post('/add', [PelanggaranController::class, 'store'])->name('pelanggaran.store'); // POST for form submission
    Route::get('/', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
});
