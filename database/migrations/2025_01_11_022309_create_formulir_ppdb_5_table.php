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
        Schema::create('formulir_ppdb_5', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_ppdb_1_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_ayah');
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('agama_ayah')->nullable();
            $table->string('kewarganegaraan_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();

            $table->string('nama_ibu');
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('agama_ibu')->nullable();
            $table->string('kewarganegaraan_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
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
        Schema::dropIfExists('formulir_ppdb_5');
    }
};
