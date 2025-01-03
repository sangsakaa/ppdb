<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formulir_ppdb_2 extends Model
{
    protected $table = 'formulir_ppdb_2';

    protected $fillable = [
        'formulir_ppdb_1_id',
        'user_id',
        'alamat',
        'kode_pos',
        'jenis_tinggal',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'status_pendaftaran',
        'catatan'
    ];
}
