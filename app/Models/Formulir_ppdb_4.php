<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulir_ppdb_4 extends Model
{
    protected $table = 'formulir_ppdb_4';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'formulir_ppdb_1_id',
        'alamat',
        'nisn',
        'nama_sekolah',
        'npsn_sekolah',
        'jenjang_sekolah',
        'status_sekolah',
        'tahun_lulus',
        'status_pendaftaran',
        'catatan',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tahun_lulus' => 'integer',
    ];
}
