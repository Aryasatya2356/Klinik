<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Poli;

class AdminController extends Controller
{
    // Tambahkan method ini
    public function dashboard()
    {
        // Menghitung Data untuk Statistik
        $totalPasien = Pasien::count();
        $totalDokter = Dokter::count();
        $totalPoli   = Poli::count();
        $totalObat   = Obat::count();
        
        // Ambil 5 User terbaru untuk tabel ringkasan
        $latestUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalPasien', 'totalDokter', 'totalPoli', 'totalObat', 'latestUsers'));
    }
}