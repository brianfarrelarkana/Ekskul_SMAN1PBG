<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperadminDashboardController;
use App\Http\Controllers\SuperadminEkskulController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/daftar_ekskul', [HomeController::class, 'daftarEkskul']);

Route::get('/ekskul/{id}', [HomeController::class, 'showEkskul']);

Route::get('/admin_login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin_login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/api/jadwal', [HomeController::class, 'jadwalJson']);

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::view('/superadmin_dashboard', 'superadmin_dashboard');
    Route::get('/superadmin_dashboard', [SuperadminDashboardController::class, 'index']);
    Route::get('/superadmin_berita', fn() => view('superadmin_berita'));
    Route::get('/superadmin_ekskul', fn() => view('superadmin_ekskul'));
    Route::get('/superadmin_ekskul', [SuperadminEkskulController::class, 'index']);
    Route::post('/superadmin_ekskul', [SuperadminEkskulController::class, 'store']);
    Route::delete('/superadmin_ekskul/{id}', [SuperadminEkskulController::class, 'destroy']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin_berita', [BeritaController::class, 'index'])->middleware(['auth', 'role:admin']);
    Route::get('/superadmin_berita', [BeritaController::class, 'index'])->middleware(['auth', 'role:superadmin']);
    Route::post('/berita', [BeritaController::class, 'store']);
    Route::put('/berita/{id}', [BeritaController::class, 'update']);
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/admin_dashboard', 'admin_dashboard');
    Route::get('/admin_dashboard', [AdminDashboardController::class, 'index']);
    Route::get('/admin_profile', fn() => view('admin_profile'));
    Route::get('/admin_profile', [ProfileController::class, 'show']);
    Route::post('/admin_profile', [ProfileController::class, 'update']);
});
