<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    // --- TAMBAHKAN BAGIAN INI ---
    protected $fillable = [
        'user_id',
        'poli_id',
        'sip',
    ];
    // ----------------------------

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id');
    }
}