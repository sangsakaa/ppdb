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
        Schema::create('formulir_ppdb_1', function (Blueprint $table) {

            $table->id(); // ID
            $table->string('kode_pendaftaran', 20); // Kode pendaftaran
            $table->unsignedBigInteger('periode_pendidikan_id'); // ID Periode Pendidikan
            $table->unsignedBigInteger('user_id'); // ID User (pengguna)
            // Data pribadi siswa
            $table->string('nomor_identitas_kependudukan'); // Nama lengkap siswa
            $table->string('nama_lengkap'); // Nama lengkap siswa
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']); // Jenis kelamin siswa
            $table->string('tempat_lahir'); // Tempat lahir siswa
            $table->date('tanggal_lahir'); // Tanggal lahir siswa
            $table->string('agama'); // Tempat lahir siswa
            $table->string('kewarganegaraan')->default('indonesia'); // Tempat lahir siswa
            $table->string('nomor_telepon')->nullable(); // Nomor telepon siswa (opsional)
            // Status pendaftaran
            $table->enum('status_pendaftaran', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu'); // Status pendaftaran
            $table->text('catatan')->nullable(); // Catatan (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_ppdb_1');
    }
};
