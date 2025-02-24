<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Formulir_ppdb_1;
use App\Models\formulir_ppdb_2;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $dataCalon = Formulir_ppdb_1::query()
        ->where('periode_pendidikan_id', session('periode_id'))
        ->where('user_id', Auth::id())
        ->first();
        $jumlahUser = $user->count();
        $StatusPendaftaran = Formulir_ppdb_1::query()
            ->leftjoin('users', 'formulir_ppdb_1.user_id', 'users.id')
            ->leftjoin('periode_pendidikan', 'formulir_ppdb_1.periode_pendidikan_id', '=', 'periode_pendidikan.id')
            ->leftjoin('formulir_ppdb_2', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_2.user_id')
            ->leftjoin('formulir_ppdb_3', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_3.user_id')
            ->leftjoin('formulir_ppdb_4', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_4.user_id')
            ->leftjoin('formulir_ppdb_5', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_5.user_id')
            // ->where('formulir_ppdb_1.periode_pendidikan_id', session('periode_id'))
            ->where('formulir_ppdb_1.user_id', auth()->id())
            ->select([
                'formulir_ppdb_1.*',
                'users.email',
                'jenjang',
            'periode_pendidikan_id',
                'periode_pendidikan.periode',
                'periode_pendidikan.semester',
                'formulir_ppdb_1.created_at',
                'formulir_ppdb_1.nama_lengkap',
                'formulir_ppdb_1.status_pendaftaran as status_1',
                'formulir_ppdb_2.status_pendaftaran as status_2',
                'formulir_ppdb_3.status_pendaftaran as status_3',
                'formulir_ppdb_4.status_pendaftaran as status_4',
                'formulir_ppdb_5.status_pendaftaran as status_5',
            ])

            ->get();
        return view(
            'dashboard',
            [
                'user' => $user,
                'StatusPendaftaran' => $StatusPendaftaran,
                'dataCalon' => $dataCalon,
                'jumlahUser' => $jumlahUser
            ]
        );
    }












    public function dasboardCalon()
    {
        
        $user_id = Auth::id();
        $result = DB::table('formulir_ppdb_1')
            ->join('formulir_ppdb_2', function ($join) {
                $join->on('formulir_ppdb_1.user_id', '=', 'formulir_ppdb_2.user_id');
            })
            ->where('formulir_ppdb_1.periode_pendidikan_id', session('periode_id'))
            ->where('formulir_ppdb_1.user_id', Auth::id())
            ->select(
                'formulir_ppdb_1.user_id',
                'formulir_ppdb_1.status_pendaftaran as status_pendaftaran_1',
                'formulir_ppdb_2.status_pendaftaran as status_pendaftaran_2'
            )
            
            ->get();

        return view('dashboard-calon', [
            'user_id' => $user_id,
            'result' => $result,
        
        ]);

    }
}
