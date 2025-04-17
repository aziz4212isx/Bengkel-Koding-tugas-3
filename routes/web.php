<?php

use App\Http\Controllers\MemeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Landing Page
Route::get('/', function () {
    return view('layout.landingpage');
});

// ========= AUTH ROUTES - DEFINISI MANUAL =========
// Login Routes
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login']);

// Logout Routes
Route::post('/auth/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

// Registration Routes
Route::get('/auth/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/auth/register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('/auth/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/auth/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/auth/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/auth/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// PENTING: HAPUS Auth::routes(); untuk menghindari konflik nama route

// Route untuk redirect setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ========= ROUTE MIDDLEWARE ROLE =========
// Route khusus Dokter
Route::middleware(['auth', CheckUserRole::class.':dokter'])->prefix('dokter')->group(function () {
    // Dashboard dokter
    Route::get('/dashboard', function () {
        return view('dokter.index');
    })->name('dokter.dashboard');
    
    // Obat Routes
    Route::get('/obat', [ObatController::class, "index"]);
    Route::get('/obat/create', [ObatController::class, "create"]);
    Route::post('/obat', [ObatController::class, "store"]);
    Route::get('/obat/{id}/edit', [ObatController::class, "edit"]);
    Route::put('/obat/{id}', [ObatController::class, "update"]);
    Route::delete('/obat/{id}', [ObatController::class, "destroy"]);
    
    // Memeriksa Routes
    Route::get('/memeriksa', [MemeriksaController::class, "index"]);
    Route::get('/memeriksa/{id}', [MemeriksaController::class, "memeriksa"]);
    Route::post('/memeriksa', [MemeriksaController::class, "store"]);
    Route::get('/memeriksa/{id}/edit', [MemeriksaController::class, "edit"]);
    Route::put('/memeriksa/{id}', [MemeriksaController::class, "update"]);
});

// Route khusus Pasien
Route::middleware(['auth', CheckUserRole::class.':pasien'])->prefix('pasien')->group(function () {
    // Dashboard pasien
    Route::get('/dashboard', function () {
        return view('pasien.index');
    })->name('pasien.dashboard');
    
    // Periksa Routes
    Route::get('/periksa', [PeriksaController::class, "index"]);
    Route::get('/periksa/create', [PeriksaController::class, "create"]);
    Route::post('/periksa', [PeriksaController::class, "store"]);
    Route::get('/periksa/{id}/edit', [PeriksaController::class, 'edit'])->name('pasien.periksa.edit');
    Route::put('/periksa/{id}', [PeriksaController::class, "update"]);
    Route::delete('/periksa/{id}', [PeriksaController::class, "destroy"]);
});

// Route khusus Admin
Route::middleware(['auth', CheckUserRole::class.':admin'])->prefix('admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');
    
    // Route admin lainnya bisa ditambahkan di sini
});