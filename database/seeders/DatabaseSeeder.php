<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Obat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Untuk hash password

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Data Master Poli (Dibutuhkan untuk tabel Dokter)
        $poliUmum = Poli::create([
            'nama_poli' => 'Poli Umum',
            'deskripsi' => 'Layanan kesehatan umum dasar.',
        ]);
        
        $poliGigi = Poli::create([
            'nama_poli' => 'Poli Gigi',
            'deskripsi' => 'Layanan kesehatan gigi dan mulut.',
        ]);

        // 2. Buat Akun ADMIN
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@klinik.com',
            'role' => 'admin',
            'password' => Hash::make('password'), // Password default
            'email_verified_at' => now(), // Langsung verifikasi agar bisa login
        ]);

        // 3. Buat Akun PERAWAT
        User::create([
            'name' => 'Suster Siti',
            'email' => 'perawat@klinik.com',
            'role' => 'perawat',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // 4. Buat Akun DOKTER (Plus data di tabel dokters)
        $userDokter = User::create([
            'name' => 'dr. Budi Santoso',
            'email' => 'dokter@klinik.com',
            'role' => 'dokter',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Isi tabel detail dokter
        Dokter::create([
            'user_id' => $userDokter->id,
            'poli_id' => $poliUmum->id,
            'sip' => '123/SIP/2025', // Contoh No. Izin Praktik
        ]);

        // 5. Buat Akun PASIEN (Plus data di tabel pasiens)
        $userPasien = User::create([
            'name' => 'Ahmad Pasien',
            'email' => 'pasien@klinik.com',
            'role' => 'pasien',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Isi tabel detail pasien
        Pasien::create([
            'user_id' => $userPasien->id,
            'tgl_lahir' => '1995-05-20',
            'gender' => 'L',
            'alamat' => 'Jl. Merdeka No. 45, Banyuwangi',
            'no_hp' => '081234567890',
        ]);

        // 6. Data Master Obat (Untuk testing resep nanti)
        Obat::create(['nama_obat' => 'Paracetamol 500mg', 'harga' => 5000, 'stok' => 100]);
        Obat::create(['nama_obat' => 'Amoxicillin 500mg', 'harga' => 12000, 'stok' => 50]);
        Obat::create(['nama_obat' => 'Vitamin C', 'harga' => 2000, 'stok' => 200]);
    }
}