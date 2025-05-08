<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DapodikController extends Controller
{
    //
    public function getDapodikData()
    {
        $npsn = "P2961645";
        $token = "4V8oTNXfhp4QMHg";

        // Melakukan request ke API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("http://192.168.138.39:5774/WebService/getPesertaDidik", [
            'npsn' => $npsn
        ]);

        // Parsing JSON response
        $data = $response->json();
        dd($data);

        // Menyiapkan array untuk hasil
        $students = [];

        if (isset($data['rows'])) {
            foreach ($data['rows'] as $row) {
                $students[] = [
                    'nama_rombongan_belajar' => $row['nama_rombel'],
                    'nama_siswa' => strtoupper($row['nama'])
                ];
            }
        }

        return response()->json($students);
        
    }
}
