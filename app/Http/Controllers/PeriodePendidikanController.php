<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodePendidikan;
use Illuminate\Support\Facades\Validator;

class PeriodePendidikanController extends Controller
{
 
    public function index()
    {
        $periodePendidikan = PeriodePendidikan::get();
        return view('administrator.periode.index',compact('periodePendidikan'));
    }
    public function create()
    {
        return view('administrator.periode.create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'periode' => 'required|min:2',
            ],
            [
                'periode.required' => 'Form tidak boleh kosong',
                'periode.min' => 'Periode harus memiliki minimal 2 karakter',
            ]
        );
        // Simpan data jika validasi berhasil
        $periodePendidikan = new PeriodePendidikan();
        $periodePendidikan->periode = $request->input('periode');
        $periodePendidikan->semester = $request->input('semester');
        $periodePendidikan->tanggal_mulai = $request->input('tanggal_mulai');
        $periodePendidikan->tanggal_akhir = $request->input('tanggal_akhir');
        $periodePendidikan->save();
        return redirect()->back()->with('success', 'Data Berhasil ditambah');

    }
    public function destroy(PeriodePendidikan $periodePendidikan){
        $periodePendidikan = PeriodePendidikan::find($periodePendidikan->id);
        if ($periodePendidikan) {
            $periodePendidikan->delete();
        }
        return redirect()->back()->with('error','hapus sukses');
    }
    

}
