<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulir_ppdb_3 extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'formulir_ppdb_3';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formulir_ppdb_1_id',
        'user_id',
        'jenjang',
        'status',
        'status_pendaftaran',
        'catatan'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'jenjang' => 'string',
        'status' => 'string',
    ];

    /**
     * Get the related user.
     */
}
