<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uploud_File extends Model
{
    protected $table = "uploud_files_ppdb";
    protected $fillable = [
        'user_id',
        'file_type',
        'file_path',
        'file_name',
        'formulir_ppdb_1_id'
    ];
}
