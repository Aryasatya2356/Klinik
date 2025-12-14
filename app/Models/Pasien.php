<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    // --- TAMBAHKAN BAGIAN INI ---
    protected $fillable = [
        'user_id',
        'tgl_lahir',
        'gender',
        'alamat',
        'no_hp',
    ];
    // ----------------------------

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}