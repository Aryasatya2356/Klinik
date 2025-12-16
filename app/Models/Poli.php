<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    // TAMBAHKAN INI
    protected $fillable = [
        'nama_poli',
        'deskripsi',
        'biaya_jasa',
    ];
}
