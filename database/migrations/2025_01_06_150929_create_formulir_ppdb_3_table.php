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
        Schema::create('formulir_ppdb_3', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_ppdb_1_id'); // Relasi ke tabel form jika diperlukan
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel siswa jika diperlukan
            $table->enum('jenjang', ['Paket A', 'Paket B', 'Paket C'])->comment('Jenjang pendidikan yang dipilih');
            $table->enum('status', ['Siswa Baru', 'Mutasi'])->comment('Status siswa');
            $table->enum('status_pendaftaran', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu'); // Status pendaftaran
            $table->text('catatan')->nullable(); // Catatan (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_ppdb_3');
    }
};
