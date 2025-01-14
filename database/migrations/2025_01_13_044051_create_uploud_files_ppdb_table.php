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
        Schema::create('uploud_files_ppdb', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users
            $table->unsignedBigInteger('formulir_ppdb_1_id');
            $table->string('file_type'); // Jenis file: KK, KTP, Ijazah
            $table->string('file_path'); // Lokasi penyimpanan file
            $table->string('file_name')->nullable(); // Nama asli file (opsional)
            // $table->string('file_extension', 10)->nullable(); // Ekstensi file (opsional)
            // $table->unsignedBigInteger('file_size')->nullable(); // Ukuran file dalam byte (opsional)
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
        Schema::dropIfExists('uploud_files_ppdb');
    }
};
