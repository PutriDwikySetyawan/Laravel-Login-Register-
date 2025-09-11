<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

// =====================
// AUTH ROUTES
// =====================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// REGISTER ROUTES
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// =====================
// DASHBOARD ROUTES
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/guru/dashboard', [DashboardController::class, 'guru'])->name('guru.dashboard');
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');
});

// =====================
// LOANS
// =====================
Route::middleware(['auth'])->group(function () {
    Route::resource('loans', LoanController::class)->only(['index', 'create', 'store']);
    Route::get('loans/history', [LoanController::class, 'history'])->name('loans.history'); // ✅ riwayat siswa
});

// =====================
// USERS MANAGEMENT
// =====================
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});

// =====================
// REPORTS
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

// =====================
// BOOKS MANAGEMENT
// =====================
Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);
});

// =====================
// SETTINGS
// =====================
Route::middleware(['auth'])->group(function () {
    Route::resource('settings', SettingController::class)->only(['index', 'update']);
});

// =====================
// UNIVERSAL DASHBOARD REDIRECT
// =====================
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $role = Auth::user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        default => redirect()->route('siswa.dashboard'),
    };
})->name('dashboard');
