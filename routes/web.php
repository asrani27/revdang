<?php

use App\Http\Controllers\Admin\GangguanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenangananController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', function () {
    return view('auth.login');
});

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Data Master Routes - User CRUD
    Route::get('/data/users', [UserController::class, 'index'])->name('data.users');
    Route::get('/data/users/create', [UserController::class, 'create'])->name('data.users.create');
    Route::post('/data/users', [UserController::class, 'store'])->name('data.users.store');
    Route::get('/data/users/{user}', [UserController::class, 'show'])->name('data.users.show');
    Route::get('/data/users/{user}/edit', [UserController::class, 'edit'])->name('data.users.edit');
    Route::put('/data/users/{user}', [UserController::class, 'update'])->name('data.users.update');
    Route::delete('/data/users/{user}', [UserController::class, 'destroy'])->name('data.users.destroy');

    // Data Master Routes - Petugas CRUD
    Route::get('/data/petugas', [PetugasController::class, 'index'])->name('data.petugas');
    Route::get('/data/petugas/create', [PetugasController::class, 'create'])->name('data.petugas.create');
    Route::post('/data/petugas', [PetugasController::class, 'store'])->name('data.petugas.store');
    Route::get('/data/petugas/{petugas}', [PetugasController::class, 'show'])->name('data.petugas.show');
    Route::get('/data/petugas/{petugas}/edit', [PetugasController::class, 'edit'])->name('data.petugas.edit');
    Route::put('/data/petugas/{petugas}', [PetugasController::class, 'update'])->name('data.petugas.update');
    Route::delete('/data/petugas/{petugas}', [PetugasController::class, 'destroy'])->name('data.petugas.destroy');
    Route::get('/data/petugas/{petugas}/create-user', [PetugasController::class, 'createUser'])->name('data.petugas.create-user');
    Route::post('/data/petugas/{petugas}/store-user', [PetugasController::class, 'storeUser'])->name('data.petugas.store-user');
    Route::get('/data/petugas/{petugas}/reset-password', [PetugasController::class, 'showResetPassword'])->name('data.petugas.reset-password.show');
    Route::put('/data/petugas/{petugas}/reset-password', [PetugasController::class, 'resetPassword'])->name('data.petugas.reset-password.update');
    // Data Master Routes - Pelanggan CRUD
    Route::get('/data/pelanggan', [PelangganController::class, 'index'])->name('data.pelanggan');
    Route::get('/data/pelanggan/create', [PelangganController::class, 'create'])->name('data.pelanggan.create');
    Route::post('/data/pelanggan', [PelangganController::class, 'store'])->name('data.pelanggan.store');
    Route::get('/data/pelanggan/{pelanggan}', [PelangganController::class, 'show'])->name('data.pelanggan.show');
    Route::get('/data/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('data.pelanggan.edit');
    Route::put('/data/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('data.pelanggan.update');
    Route::delete('/data/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('data.pelanggan.destroy');
    Route::get('/data/pelanggan/{pelanggan}/create-user', [PelangganController::class, 'createUser'])->name('data.pelanggan.create-user');
    Route::post('/data/pelanggan/{pelanggan}/store-user', [PelangganController::class, 'storeUser'])->name('data.pelanggan.store-user');
    Route::get('/data/pelanggan/{pelanggan}/reset-password', [PelangganController::class, 'showResetPassword'])->name('data.pelanggan.reset-password.show');
    Route::put('/data/pelanggan/{pelanggan}/reset-password', [PelangganController::class, 'resetPassword'])->name('data.pelanggan.reset-password.update');
    // Data Master Routes - Gangguan CRUD
    Route::get('/data/gangguan', [GangguanController::class, 'index'])->name('data.gangguan');
    Route::get('/data/gangguan/create', [GangguanController::class, 'create'])->name('data.gangguan.create');
    Route::post('/data/gangguan', [GangguanController::class, 'store'])->name('data.gangguan.store');
    Route::get('/data/gangguan/{gangguan}', [GangguanController::class, 'show'])->name('data.gangguan.show');
    Route::get('/data/gangguan/{gangguan}/edit', [GangguanController::class, 'edit'])->name('data.gangguan.edit');
    Route::put('/data/gangguan/{gangguan}', [GangguanController::class, 'update'])->name('data.gangguan.update');
    Route::delete('/data/gangguan/{gangguan}', [GangguanController::class, 'destroy'])->name('data.gangguan.destroy');
    // Data Master Routes - Pengaduan CRUD
    Route::get('/data/pengaduan', [PengaduanController::class, 'index'])->name('data.pengaduan');
    Route::get('/data/pengaduan/create', [PengaduanController::class, 'create'])->name('data.pengaduan.create');
    Route::post('/data/pengaduan', [PengaduanController::class, 'store'])->name('data.pengaduan.store');
    Route::get('/data/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('data.pengaduan.show');
    Route::get('/data/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('data.pengaduan.edit');
    Route::put('/data/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('data.pengaduan.update');
    Route::delete('/data/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('data.pengaduan.destroy');
    // Data Master Routes - Penanganan CRUD
    Route::get('/data/penanganan', [PenangananController::class, 'index'])->name('data.penanganan');
    Route::get('/data/penanganan/create', [PenangananController::class, 'create'])->name('data.penanganan.create');
    Route::post('/data/penanganan', [PenangananController::class, 'store'])->name('data.penanganan.store');
    Route::get('/data/penanganan/{penanganan}', [PenangananController::class, 'show'])->name('data.penanganan.show');
    Route::get('/data/penanganan/{penanganan}/edit', [PenangananController::class, 'edit'])->name('data.penanganan.edit');
    Route::put('/data/penanganan/{penanganan}', [PenangananController::class, 'update'])->name('data.penanganan.update');
    Route::delete('/data/penanganan/{penanganan}', [PenangananController::class, 'destroy'])->name('data.penanganan.destroy');
    // Data Master Routes - Feedback CRUD
    Route::get('/data/feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('data.feedback');
    Route::get('/data/feedback/create', [App\Http\Controllers\Admin\FeedbackController::class, 'create'])->name('data.feedback.create');
    Route::post('/data/feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'store'])->name('data.feedback.store');
    Route::get('/data/feedback/{feedback}', [App\Http\Controllers\Admin\FeedbackController::class, 'show'])->name('data.feedback.show');
    Route::get('/data/feedback/{feedback}/edit', [App\Http\Controllers\Admin\FeedbackController::class, 'edit'])->name('data.feedback.edit');
    Route::put('/data/feedback/{feedback}', [App\Http\Controllers\Admin\FeedbackController::class, 'update'])->name('data.feedback.update');
    Route::delete('/data/feedback/{feedback}', [App\Http\Controllers\Admin\FeedbackController::class, 'destroy'])->name('data.feedback.destroy');
    Route::get('/data/log-aktivitas', [App\Http\Controllers\Admin\LogAktivitasController::class, 'index'])->name('data.log-aktivitas');
    Route::get('/data/log-aktivitas/{logAktivitas}', [App\Http\Controllers\Admin\LogAktivitasController::class, 'show'])->name('data.log-aktivitas.show');
    Route::delete('/data/log-aktivitas/clear-all', [App\Http\Controllers\Admin\LogAktivitasController::class, 'clearAll'])->name('data.log-aktivitas.clear-all');
    Route::delete('/data/log-aktivitas/clear-old', [App\Http\Controllers\Admin\LogAktivitasController::class, 'clearOld'])->name('data.log-aktivitas.clear-old');

    // Laporan Routes
    Route::get('/laporan/user', [LaporanController::class, 'user'])->name('laporan.user');
    Route::get('/laporan/user/pdf', [LaporanController::class, 'userPdf'])->name('laporan.user.pdf');
    Route::get('/laporan/petugas', [LaporanController::class, 'petugas'])->name('laporan.petugas');
    Route::get('/laporan/petugas/pdf', [LaporanController::class, 'petugasPdf'])->name('laporan.petugas.pdf');
    Route::get('/laporan/pelanggan', [LaporanController::class, 'pelanggan'])->name('laporan.pelanggan');
    Route::get('/laporan/pelanggan/pdf', [LaporanController::class, 'pelangganPdf'])->name('laporan.pelanggan.pdf');
    Route::get('/laporan/gangguan', [LaporanController::class, 'gangguan'])->name('laporan.gangguan');
    Route::get('/laporan/gangguan/pdf', [LaporanController::class, 'gangguanPdf'])->name('laporan.gangguan.pdf');
    Route::get('/laporan/pengaduan', [LaporanController::class, 'pengaduan'])->name('laporan.pengaduan');
    Route::get('/laporan/pengaduan/pdf', [LaporanController::class, 'pengaduanPdf'])->name('laporan.pengaduan.pdf');
    Route::get('/laporan/penanganan', [LaporanController::class, 'penanganan'])->name('laporan.penanganan');
    Route::get('/laporan/penanganan/pdf', [LaporanController::class, 'penangananPdf'])->name('laporan.penanganan.pdf');
    Route::get('/laporan/feedback', [LaporanController::class, 'feedback'])->name('laporan.feedback');
    Route::get('/laporan/feedback/pdf', [LaporanController::class, 'feedbackPdf'])->name('laporan.feedback.pdf');
    Route::get('/laporan/log-aktivitas', [LaporanController::class, 'logAktivitas'])->name('laporan.log-aktivitas');
    Route::get('/laporan/log-aktivitas/pdf', [LaporanController::class, 'logAktivitasPdf'])->name('laporan.log-aktivitas.pdf');
});

// Petugas Routes
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    })->name('dashboard');

    Route::get('/pengaduan', function () {
        return view('petugas.pengaduan.index');
    })->name('pengaduan.index');
    Route::get('/penanganan', function () {
        return view('petugas.penanganan.index');
    })->name('penanganan.index');
    Route::get('/gangguan', function () {
        return view('petugas.gangguan.index');
    })->name('gangguan.index');
});

// Pelanggan Routes
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Pelanggan\PelangganController::class, 'dashboard'])->name('dashboard');

    // Pengaduan Routes
    Route::get('/pengaduan', [App\Http\Controllers\Pelanggan\PelangganController::class, 'pengaduanIndex'])->name('pengaduan.index');
    Route::get('/pengaduan/create', [App\Http\Controllers\Pelanggan\PelangganController::class, 'pengaduanCreate'])->name('pengaduan.create');
    Route::post('/pengaduan', [App\Http\Controllers\Pelanggan\PelangganController::class, 'pengaduanStore'])->name('pengaduan.store');
    Route::get('/pengaduan/{id}', [App\Http\Controllers\Pelanggan\PelangganController::class, 'pengaduanShow'])->name('pengaduan.show');

    // Gangguan Routes
    Route::get('/gangguan', [App\Http\Controllers\Pelanggan\PelangganController::class, 'gangguanIndex'])->name('gangguan.index');
    Route::get('/gangguan/{id}', [App\Http\Controllers\Pelanggan\PelangganController::class, 'gangguanShow'])->name('gangguan.show');

    // Feedback Routes
    Route::get('/feedback', [App\Http\Controllers\Pelanggan\PelangganController::class, 'feedbackIndex'])->name('feedback.index');
    Route::get('/feedback/create', [App\Http\Controllers\Pelanggan\PelangganController::class, 'feedbackCreate'])->name('feedback.create');
    Route::post('/feedback', [App\Http\Controllers\Pelanggan\PelangganController::class, 'feedbackStore'])->name('feedback.store');
});
