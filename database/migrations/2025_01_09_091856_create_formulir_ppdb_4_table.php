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
        Schema::create('formulir_ppdb_4', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_ppdb_1_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_sekolah');
            $table->string('npsn_sekolah')->default('-');
            $table->enum('jenjang_sekolah', ['smp', 'sd'])->default('sd');
            $table->string('status_sekolah')->default('negeri');
            $table->string('nisn')->nullable();
            $table->text('alamat');
            $table->year('tahun_lulus');
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
        Schema::dropIfExists('formulir_ppdb_4');
    }
};
