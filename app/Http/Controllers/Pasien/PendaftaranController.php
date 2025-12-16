<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // 1. Tampilkan Form Pendaftaran
    public function create()
    {
        // Ambil data dokter beserta polinya untuk ditampilkan di dropdown
        $dokters = Dokter::with(['user', 'poli'])->get();
        
        return view('pasien.daftar', compact('dokters'));
    }

    // 2. Proses Simpan Data
    public function store(Request $request)
    {
        $maxDate = now()->addDays(3)->format('Y-m-d');
        // Validasi input
        $request->validate([
        'id_dokter' => 'required|exists:dokters,id',
        'keluhan' => 'required|string',
        
        // UPDATE VALIDASI TANGGAL DI SINI:
        'tgl_kunjungan' => [
            'required',
            'date',
            'after_or_equal:today',      // Tidak boleh hari kemarin
            'before_or_equal:' . $maxDate // Maksimal 3 hari ke depan
        ],
        ], [
        // Custom Pesan Error (Opsional, biar bahasa manusia)
        'tgl_kunjungan.after_or_equal' => 'Tanggal kunjungan tidak boleh lewat (minimal hari ini).',
        'tgl_kunjungan.before_or_equal' => 'Pendaftaran maksimal hanya untuk 3 hari ke depan.',
        ]);

        // Cari ID Pasien berdasarkan User yang login
        // (Asumsi: User yang login pasti punya data di tabel 'pasiens')
        $pasien = Pasien::where('user_id', Auth::id())->first();

        if (!$pasien) {
            return back()->with('error', 'Data profil pasien belum lengkap. Hubungi Admin.');
        }

        // Logic Nomor Antrian Sederhana (Contoh: A-001, A-002)
        // Hitung jumlah pendaftar hari ini
        $jumlahHariIni = Pendaftaran::whereDate('created_at', today())->count();
        $noAntrian = 'A-' . str_pad($jumlahHariIni + 1, 3, '0', STR_PAD_LEFT);

        // Simpan ke Database
        Pendaftaran::create([
            'no_antrian' => $noAntrian,
            'id_pasien' => $pasien->id,
            'id_dokter' => $request->id_dokter,
            'tgl_kunjungan' => $request->tgl_kunjungan,
            'keluhan' => $request->keluhan,
            'status' => 'terdaftar',
        ]);

        return redirect()->route('dashboard')->with('success', 'Berhasil mendaftar! Nomor Antrian Anda: ' . $noAntrian);
    }

    public function riwayat()
    {
        // Ambil data pasien dari user yang login
        $pasienId = Auth::user()->pasien->id;

        // Ambil pendaftaran yang statusnya 'selesai'
        // Load relasi dokter, poli, dan obat-obatan yang diresepkan
        $riwayat = Pendaftaran::where('id_pasien', $pasienId)
            ->where('status', 'selesai')
            ->with(['dokter.user', 'dokter.poli', 'obats']) 
            ->orderBy('tgl_kunjungan', 'desc')
            ->get();

        return view('pasien.riwayat', compact('riwayat'));
    }
}