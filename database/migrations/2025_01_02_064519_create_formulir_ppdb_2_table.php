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
        Schema::create('formulir_ppdb_2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_ppdb_1_id'); // Foreign key for students table
            $table->unsignedBigInteger('user_id'); // Foreign key for students table
            $table->string('alamat', 255); // Alamat lengkap
            $table->string('kode_pos', 10)->nullable(); // Kode Pos
            $table->enum('jenis_tinggal', ['orang_tua', 'wali', 'kos', 'asrama', 'lainnya'])->default('orang_tua'); // Jenis tempat 
            $table->unsignedBigInteger('province_id'); // Province ID
            $table->unsignedBigInteger('regency_id'); // Regency ID
            $table->unsignedBigInteger('district_id'); // District ID
            $table->unsignedBigInteger('village_id'); // Village ID
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
        Schema::dropIfExists('formulir_ppdb_2');
    }
};
