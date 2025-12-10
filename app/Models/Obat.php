<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Obat extends Model
{
    use HasFactory;

    // Tambahkan property $fillable ini
    protected $fillable = [
        'nama_obat',
        'harga',
        'stok',
    ];
}