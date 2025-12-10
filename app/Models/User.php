<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // [cite: 1482]
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Tambahkan "implements MustVerifyEmail" sesuai instruksi modul [cite: 1483]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan 'role' dimasukkan ke fillable agar bisa diisi [cite: 1640]
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pasien() {
        return $this->hasOne(Pasien::class, 'user_id');
    }
    public function dokter() { 
        return $this->hasOne(Dokter::class, 'user_id'); 
    }
}