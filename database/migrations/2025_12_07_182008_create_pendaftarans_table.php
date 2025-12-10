<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_antrian'); // Contoh: A-001
            
            // Relasi
            $table->foreignId('id_pasien')->constrained('pasiens');
            $table->foreignId('id_dokter')->constrained('dokters');
            
            $table->date('tgl_kunjungan');
            $table->text('keluhan'); // Diisi Pasien
            
            // Diisi Dokter nanti
            $table->text('diagnosa')->nullable();
            $table->text('tindakan_dokter')->nullable();
            
            // Status alur (Flow)
            $table->enum('status', ['terdaftar', 'menunggu_dokter', 'menunggu_pembayaran', 'selesai', 'batal'])
            ->default('terdaftar');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
