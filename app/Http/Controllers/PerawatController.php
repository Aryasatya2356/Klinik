<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PerawatController extends Controller
{
    public function index()
    {
        // 1. Antrian Pasien Baru (Butuh Validasi)
        $antrianBaru = Pendaftaran::where('status', 'terdaftar')
            ->orderBy('tgl_kunjungan', 'asc')
            ->with(['pasien.user', 'dokter.poli'])
            ->get();

        // 2. Antrian Sedang Diperiksa (Info saja)
        $antrianMenunggu = Pendaftaran::where('status', 'menunggu_dokter')
            ->get();

        // 3. Antrian Pembayaran (KASIR) - INI YANG BARU KITA TAMBAHKAN
        // Kita butuh relasi 'obats' untuk menghitung total harga nanti
        $antrianPembayaran = Pendaftaran::where('status', 'menunggu_pembayaran')
            ->with(['pasien.user', 'obats', 'dokter.poli'])
            ->get();

        return view('perawat.dashboard', compact('antrianBaru', 'antrianMenunggu', 'antrianPembayaran'));
    }

    public function validasi($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => 'menunggu_dokter']);
        return back()->with('success', 'Pasien berhasil divalidasi.');
    }

    // TAMBAHKAN FUNGSI INI: Proses Pembayaran (Selesai)
    public function bayar($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Ubah status jadi selesai (History Record)
        $pendaftaran->update(['status' => 'selesai']);

        return back()->with('success', 'Pembayaran berhasil. Pasien telah selesai berobat.');
    }
}