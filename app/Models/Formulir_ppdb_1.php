<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulir_ppdb_1 extends Model
{
    protected $table = 'formulir_ppdb_1';
    protected $fillable = [
        
        'kode_pendaftaran',
        'periode_pendidikan_id',
        'user_id',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nomor_telepon',
        'status_pendaftaran',
        'catatan',
        'kewarganegaraan',
        'nomor_identitas_kependudukan',
    ];

}
