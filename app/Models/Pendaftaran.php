<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Obat;

class Pendaftaran extends Model
{
    protected $fillable = [
    'no_antrian',
    'id_pasien',
    'id_dokter',
    'tgl_kunjungan',
    'keluhan',
    'status',
    'diagnosa',
    'tindakan_dokter'
    // Diagnosa & Tindakan nanti diisi dokter, jadi boleh null
];

    // Relasi agar nanti bisa panggil $pendaftaran->dokter->user->name
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'pendaftaran_obat');
    }
}
