<?php

// routes/web.php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien\PendaftaranController;
use App\Models\Pendaftaran;
use App\Http\Controllers\PerawatController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\Admin\AdminController;


Route::get('/', function () {
    return view('welcome');
});

// Rute untuk PASIEN (Role: pasien)
Route::middleware(['auth', 'role:pasien', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        // Ambil pendaftaran terakhir pasien yang statusnya BELUM 'selesai'
        $pendaftaranAktif = Pendaftaran::where('id_pasien', Auth::user()->pasien->id)
            ->where('status', '!=', 'selesai')
            ->latest()
            ->first();

        return view('dashboard_pasien', compact('pendaftaranAktif'));
    })->name('dashboard');

    Route::get('/pasien/daftar', [PendaftaranController::class, 'create'])->name('pasien.daftar');
    Route::post('/pasien/daftar', [PendaftaranController::class, 'store'])->name('pasien.simpan');

    Route::get('/pasien/riwayat', [PendaftaranController::class, 'riwayat'])->name('pasien.riwayat');
    Route::get('/jadwal-dokter', [App\Http\Controllers\Pasien\PasienController::class, 'jadwal'])->name('pasien.jadwal');
});

// Rute untuk DOKTER (Role: dokter)
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
    
    // Rute Periksa
    Route::get('/dokter/periksa/{id}', [DokterController::class, 'periksa'])->name('dokter.periksa');
    Route::put('/dokter/periksa/{id}', [DokterController::class, 'update'])->name('dokter.update');
});

// Rute untuk ADMIN (Role: admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('/admin/obat', \App\Http\Controllers\Admin\ObatController::class);
    Route::resource('/admin/poli', \App\Http\Controllers\Admin\PoliController::class);
    Route::resource('/admin/user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('jadwal', \App\Http\Controllers\Admin\JadwalDokterController::class);
});

// routes/web.php

// ... rute dokter dan admin ...

// Rute untuk PERAWAT (Role: perawat)
Route::middleware(['auth', 'role:perawat'])->group(function () {
    Route::get('/perawat/dashboard', [PerawatController::class, 'index'])->name('perawat.dashboard');
    Route::patch('/perawat/validasi/{id}', [PerawatController::class, 'validasi'])->name('perawat.validasi');

    Route::patch('/perawat/bayar/{id}', [PerawatController::class, 'bayar'])->name('perawat.bayar');
});

// Rute Autentikasi Bawaan (Profile, dll)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile/patient', [ProfileController::class, 'updatePatient'])->name('profile.patient.update');
});
Route::get('/jadwal-dokter', [App\Http\Controllers\Pasien\PasienController::class, 'jadwal'])->name('pasien.jadwal');

require __DIR__.'/auth.php';
