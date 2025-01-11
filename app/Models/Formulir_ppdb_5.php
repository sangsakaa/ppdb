<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulir_ppdb_5 extends Model
{
    protected $table = 'formulir_ppdb_5';

    protected $fillable = [
        'formulir_ppdb_1_id',
        'user_id',
        'nama_ayah',
        'tanggal_lahir_ayah',
        'agama_ayah',
        'kewarganegaraan_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'agama_ibu',
        'kewarganegaraan_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'status_pendaftaran',
        'catatan',

    ];
}
