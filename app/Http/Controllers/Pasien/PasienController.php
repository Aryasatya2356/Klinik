<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalDokter;

class PasienController extends Controller
{
    public function jadwal()
{
    // Mengelompokkan jadwal berdasarkan Hari agar mudah ditampilkan
    $jadwals = JadwalDokter::with(['dokter.user', 'dokter.poli'])
                ->get()
                ->groupBy('hari'); // Hasilnya: ['Senin' => [...], 'Selasa' => [...]]

    // Urutan hari custom agar Senin selalu di awal
    $urutanHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    return view('pasien.jadwal', compact('jadwals', 'urutanHari'));
}
}
