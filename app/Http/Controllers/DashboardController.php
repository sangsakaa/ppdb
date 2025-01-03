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
        return view('dashboard',compact('user','dataCalon', 'jumlahUser'));
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
