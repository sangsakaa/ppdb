<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Formulir_ppdb_1;
use App\Models\formulir_ppdb_2;
use App\Models\Formulir_ppdb_3;
use App\Models\Formulir_ppdb_4;
use App\Models\Formulir_ppdb_5;
use Barryvdh\DomPDF\Facade\Pdf;
use function Illuminate\Log\log;
use App\Models\PeriodePendidikan;
use App\Models\Uploud_File;
use Doctrine\DBAL\Query\From;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormulirController extends Controller
{
    // FORMULIR PENDAFTARAN PERTAMA DATA DIRI
    public function index(  )
    {
        $dataCalon = Formulir_ppdb_1::query()
            ->leftjoin('users', 'formulir_ppdb_1.user_id', 'users.id')
            ->leftjoin('periode_pendidikan', 'formulir_ppdb_1.periode_pendidikan_id', '=', 'periode_pendidikan.id')
            ->leftjoin('formulir_ppdb_2', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_2.user_id')
            ->leftjoin('formulir_ppdb_3', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_3.user_id')
            ->leftjoin('formulir_ppdb_4', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_4.user_id')
            ->leftjoin('formulir_ppdb_5', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_5.user_id')
            ->where('formulir_ppdb_1.periode_pendidikan_id', session('periode_id'))
            ->select([
                'formulir_ppdb_1.*',
            'users.email',
            'jenjang',
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
        ->paginate(10);
        return view('administrator.ppdb.index', 
        [   
            'dataCalon' => $dataCalon,
        ]);

    }
    public function create( $formulir_ppdb_1)
    {   
        $formulir_ppdb_1 = Formulir_ppdb_1::where('user_id', $formulir_ppdb_1)->first();
        return view('administrator.ppdb.form_ppdb_1', [
            'formulir_ppdb_1' => $formulir_ppdb_1,
        ]);

    }

    private function generateRegistrationCode()
    {
        $currentYearMonth = Carbon::now()->format('Y-m');

        // Cari kode registrasi terakhir berdasarkan format
        $lastCode = Formulir_ppdb_1::where('kode_pendaftaran', 'like', "$currentYearMonth-%")
        ->orderBy('kode_pendaftaran', 'desc')
        ->first();

        // Generate nomor baru
        if ($lastCode) {
            $lastNumber = (int) substr($lastCode->kode_pendaftaran, -5); // Ambil 5 digit terakhir
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '00001'; // Default untuk registrasi pertama
        }

        return "$currentYearMonth-$newNumber";
    }

    public function store(Request $request, $formulir_ppdb_1 = null)
    {

        // dd($formulir_ppdb_1->user_id);
        // dd($request);
        // $request->validate([
        //     // 'user_id' => 'required',
        //     'nomor_identitas_kependudukan' => 'required',
        //     'nama_lengkap' => 'required|string|max:255',
        //     'jenis_kelamin' => 'required|', // L untuk laki-laki, P untuk perempuan
        //     'tempat_lahir' => 'required|string|max:255',
        //     'tanggal_lahir' => 'required|date',
        //     'agama' => 'required|string|max:50',
        //     'alamat' => 'required|string|max:500',
        //     'nomor_telepon' => 'required',
        //     'status_pendaftaran' => 'nullable|in:menunggu,diterima,ditolak',
        //     'catatan' => 'nullable|string|max:500',
        // ]);
        
        $periode_pendidikan = PeriodePendidikan::latest()->first();
        
        $existingRegistration = Formulir_ppdb_1::where('user_id', $formulir_ppdb_1)->first();
        if ($existingRegistration) {
            // Output existing registration data for debugging
            Log::info('Existing Registration:', ['registration' => $existingRegistration]);
        }

        $registration = Formulir_ppdb_1::updateOrCreate(
            [
                'user_id' => $formulir_ppdb_1 ,
            ],
            [
                'kode_pendaftaran' => $this->generateRegistrationCode(),
                'periode_pendidikan_id' => $periode_pendidikan->id,
                'nomor_identitas_kependudukan' => $request->nomor_identitas_kependudukan,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
                'status_pendaftaran' => $request->status_pendaftaran ?? 'menunggu',
                'catatan' => $request->catatan,
            ]
            
            
        );
        

        return redirect()->back()->with('success', 'Pendaftaran berhasil ' . ($registration->wasRecentlyCreated ? 'dibuat.' : 'diperbarui.'));



    }

    public function updateStatus(Request $request)
    {
        
        $validated = $request->validate([
            'status_pendaftaran' => 'required|in:disetujui,ditolak,menunggu',  // Validasi status yang diizinkan
            'user_id' => 'required|integer|exists:formulir_ppdb_1,user_id',  // Pastikan user_id ada di database
        ]);

        // Ambil nilai status dan user_id dari form
        $status_pendaftaran = $validated['status_pendaftaran'];
        $user_id = $validated['user_id'];

        // Query untuk memperbarui status
        $ppdbForm = Formulir_ppdb_1::where('user_id', $user_id)->first();

        // Jika data ditemukan, update status
        if ($ppdbForm) {
            $ppdbForm->status_pendaftaran = $status_pendaftaran;

            // Jika status_pendaftaran adalah "Approved", isi kolom tambahan
            if (strtolower($status_pendaftaran) === 'disetujui') {
                $ppdbForm->catatan = 'ok sudah valid'; // Ganti "additional_column" dengan nama kolom sebenarnya
                $ppdbForm->save();  // Simpan perubahan
                return redirect()->back()->with('success', 'Status berhasil diperbarui!');
            }   if(strtolower($status_pendaftaran) === 'ditolak'){
                $ppdbForm->catatan = 'Masih ada Kesalahan'; // Ganti "additional_column" dengan nama kolom sebenarnya
                $ppdbForm->save();  // Simpan perubahan
                return redirect()->back()->with('danger', 'Status berhasil diperbarui!');
            }   if(strtolower($status_pendaftaran) === 'menunggu'){
                $ppdbForm->catatan = 'Masih Dalam antrian'; // Ganti "additional_column" dengan nama kolom sebenarnya
                $ppdbForm->save();  // Simpan perubahan
                return redirect()->back()->with('warning', 'Status berhasil diperbarui!');
            }
        }

        // Jika user_id tidak ditemukan
        return redirect()->back()->with('error', 'User tidak ditemukan.');

    }
    public function ValidasCalonPeserta( $calon_peserta ,Request $request)
    {
        // dd($calon_peserta);
        $periode_pendidikan_id = PeriodePendidikan::latest()->first();
        $dataCalon = Formulir_ppdb_1::query()
            ->join('periode_pendidikan', 'formulir_ppdb_1.periode_pendidikan_id', 'periode_pendidikan.id')
            ->select('formulir_ppdb_1.*')
            ->where('formulir_ppdb_1.user_id', $calon_peserta)
            ->first();
        return view('administrator.ppdb.validasi-calon-peserta',compact('periode_pendidikan_id', 'dataCalon') );
        }
        public function UpdateValidasiCalonPeserta($calon_peserta, Request $request)
        {
        // dd($request);
        // Validasi data
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        // Cari data berdasarkan ID
        $ppdbForm = Formulir_ppdb_1::findOrFail($calon_peserta);

        // Update hanya field 'notes'
        $ppdbForm->update([
            'notes' => $request->input('notes'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        }



    // FORMULIR PENDAFTARAN KEDUA KETERANGAN TEMPAT TINGGAL
    public function formulir_ppdb_2(Request $request, $formulir_ppdb_1 = null)
    {
        // Mengambil data untuk dropdown
        // dd($formulir_ppdb_1);
        $form1 = Formulir_ppdb_1::where('user_id', $formulir_ppdb_1)->first();
        $form2 = Formulir_ppdb_2::where('user_id', $formulir_ppdb_1)->first();  
        $provinces = DB::table('provinces')->get();
        $regencies = DB::table('regencies')->get();
        $districts = DB::table('districts')->get();
        $villages = DB::table('villages')->get();
        return view('administrator.ppdb.form_ppdb_2',
         compact(
            'provinces',
            'regencies',
            'districts',
            'villages',
            'form1',
            'form2',
                'formulir_ppdb_1'
        )
        );
    }
    public function storeformulir_ppdb_2(Request $request, $formulir_ppdb_1 = null)
    {

        // dd($request);
        // $request->validate([
        //     'formulir_ppdb_1_id' => 'required|string|max:255',
        //     'user_id' => 'required|string|max:255',
        //     'alamat' => 'required|string|max:255',
        //     'kode_pos' => 'required|string|max:10',
        //     'jenis_tinggal' => 'required|string|max:100',
        //     'province_id' => 'required|integer|exists:provinces,id',
        //     'regency_id' => 'required|integer|exists:regencies,id',
        //     'district_id' => 'required|integer|exists:districts,id',
        //     'village_id' => 'required|integer|exists:villages,id',
        //     'status_pendaftaran' => 'required|string',
        //     'catatan' => 'nullable|string',
        // ]);
        $existingRegistration = Formulir_ppdb_2::where('user_id', Auth::id())->first();
        if ($existingRegistration) {
            // Output existing registration data for debugging
            Log::info('Existing Registration:', ['registration' => $existingRegistration]);
        }

        $registration = Formulir_ppdb_2::updateOrCreate(
            [
                'user_id' => $formulir_ppdb_1,
            ],
            [   
                'formulir_ppdb_1_id' => $request->formulir_ppdb_1_id,
                // 'user_id' => $request->user_id,
                'alamat' => $request->alamat,
                'kode_pos' => $request->kode_pos,
                'jenis_tinggal' => $request->jenis_tinggal,
                'province_id' => $request->province_id,
                'regency_id' => $request->regency_id,
                'district_id' => $request->district_id,
                'village_id' => $request->village_id,
                'status_pendaftaran' => $request->status_pendaftaran ?? 'menunggu',
                'catatan' => $request->catatan ?? 'masih dalam antrian',
            ]
        );

        return redirect()->back()->with('success', 'Pendaftaran berhasil ' . ($registration->wasRecentlyCreated ? 'dibuat.' : 'diperbarui.'));
    }
    public function getRegencies($provinceId)
    {
        $regencies = DB::table('regencies')->where('province_id', $provinceId)->get();
        return response()->json($regencies);
    }

    public function getDistricts($regencyId)
    {
        $districts = DB::table('districts')->where('regency_id', $regencyId)->get();
        return response()->json($districts);
    }

    public function getVillages($districtId)
    {
        $villages = DB::table('villages')->where('district_id', $districtId)->get();
        return response()->json($villages);
    }



    public function formulir_ppdb_3(Request $request, $formulir_ppdb_1 = null)
    {
        $form1 = Formulir_ppdb_1::where(
            'user_id',
            $formulir_ppdb_1
        )->first();
        $form3 = Formulir_ppdb_3::where(
            'user_id',
            $formulir_ppdb_1
        )->first();
        return view(
            'administrator.ppdb.form_ppdb_3',
            [
                'form1' => $form1,
                'formulir_ppdb_1' => $formulir_ppdb_1,
                'form3' => $form3,
            ]
        );
    }
    public function storeformulir_ppdb_3(Request $request, $formulir_ppdb_1)
    {
        $existingRegistration = Formulir_ppdb_3::where('user_id', Auth::id())->first();
        if ($existingRegistration) {
            // Output existing registration data for debugging
            Log::info('Existing Registration:', ['registration' => $existingRegistration]);
        }

        $registration = Formulir_ppdb_3::updateOrCreate(
            [
                'user_id' => $formulir_ppdb_1,
                'formulir_ppdb_1_id' => $request->formulir_ppdb_1_id,
            ],
            [
                'jenjang' => $request->jenjang,
                'status' => $request->status,
                'status_pendaftaran' => $request->status_pendaftaran ?? 'menunggu',
                'catatan' => $request->catatan ?? 'masih dalam antrian',
            ]
        );

        return redirect()->back()->with(
            'success',
            'Pendaftaran berhasil ' . ($registration->wasRecentlyCreated ? 'dibuat.' : 'diperbarui.')
        );
    }

    // formulir 4 riwayat pendidik
    public function formulir_ppdb_4(Request $request, $formulir_ppdb_1 = null)
    {
        // dd($formulir_ppdb_1);
        $form1 = Formulir_ppdb_1::where(
            'user_id',
            $formulir_ppdb_1
        )->first();
        $form4 = formulir_ppdb_4::where(
            'user_id',
            $formulir_ppdb_1
        )->first();

        return view(
            'administrator.ppdb.form_ppdb_4',
            [
                'formulir_ppdb_1' => $formulir_ppdb_1,
                'form1' => $form1,
                'form4' => $form4
            ]
        );
    }
    public function storeformulir_ppdb_4(Request $request, $formulir_ppdb_1 = null)
    {

        // dd($request);
        $existingRegistration = formulir_ppdb_4::where('user_id', $formulir_ppdb_1)->first();
        if ($existingRegistration) {
            // Output existing registration data for debugging
            Log::info('Existing Registration:', ['registration' => $existingRegistration]);
        }

        $registration = Formulir_ppdb_4::updateOrCreate(
            [
                'user_id' => $formulir_ppdb_1,
            ],
            [
                'formulir_ppdb_1_id' => $request->formulir_ppdb_1_id,
                'alamat' => $request->alamat,
                'nisn' => $request->nisn,
                'npsn_sekolah' => $request->npsn_sekolah,
                'nama_sekolah' => $request->nama_sekolah,
                'jenjang_sekolah' => $request->jenjang_sekolah,
                'status_sekolah' => $request->status_sekolah,
                'tahun_lulus' => $request->tahun_lulus,
                'status_pendaftaran' => $request->status_pendaftaran ?? 'menunggu',
                'catatan' => $request->catatan ?? 'masih dalam antrian',
            ]
        );
        return redirect()->back()->with(
            'success',
            'Pendaftaran berhasil ' . ($registration->wasRecentlyCreated ? 'dibuat.' : 'diperbarui.')
        );
    }
    public function formulir_ppdb_5(Request $request, $formulir_ppdb_1 = null)
    {
        // dd($formulir_ppdb_1);
        $form1 = Formulir_ppdb_1::where(
            'user_id',
            $formulir_ppdb_1
        )->first();
        $form5 = formulir_ppdb_5::where(
            'user_id',
            $formulir_ppdb_1
        )->first();

        return view(
            'administrator.ppdb.form_ppdb_5',
            [
                'formulir_ppdb_1' => $formulir_ppdb_1,
                'form1' => $form1,
                'form5' => $form5
            ]
        );
    }
    public function storeformulir_ppdb_5(Request $request, $formulir_ppdb_1 = null)
    {

        // dd($request);
        $existingRegistration = Formulir_ppdb_5::where('user_id', $formulir_ppdb_1)->first();
        if ($existingRegistration) {
            // Output existing registration data for debugging
            Log::info('Existing Registration:', ['registration' => $existingRegistration]);
        }

        $registration = Formulir_ppdb_5::updateOrCreate(
            [
                'user_id' => $formulir_ppdb_1,
            ],
            [
                'formulir_ppdb_1_id' => $request->formulir_ppdb_1_id,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'agama_ibu' => $request->agama_ibu,
                'agama_ayah' => $request->agama_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'status_pendaftaran' => $request->status_pendaftaran ?? 'menunggu',
                'catatan' => $request->catatan ?? 'masih dalam antrian',
            ]
        );
        return redirect()->back()->with(
            'success',
            'Pendaftaran berhasil ' . ($registration->wasRecentlyCreated ? 'dibuat.' : 'diperbarui.')
        );
    }
    

    public function generatePdf($calon_peserta)
    {
        // dd($calon_peserta);
        $periode_pendidikan_id = PeriodePendidikan::latest()->first();
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;
        // $tanggalCetak = Carbon::now();
        // Case untuk bulan ke romawi
        $bulanRomawi = match ($bulan) {
            1 => 'I',  // Januari
            2 => 'II', // Februari
            3 => 'III', // Maret
            4 => 'IV', // April
            5 => 'V',  // Mei
            6 => 'VI', // Juni
            7 => 'VII', // Juli
            8 => 'VIII', // Agustus
            9 => 'IX',  // September
            10 => 'X',  // Oktober
            11 => 'XI', // November
            12 => 'XII', // Desember
            default => null,
        };
        // $user_id = Auth::id();
        $data = DB::table('formulir_ppdb_1')
        ->join('formulir_ppdb_2', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_2.user_id')
            ->join('formulir_ppdb_3', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_3.user_id')
            ->join('formulir_ppdb_4', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_4.user_id')
            ->join('formulir_ppdb_5', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_5.user_id')
            
        ->join('periode_pendidikan', 'formulir_ppdb_1.periode_pendidikan_id', '=', 'periode_pendidikan.id')
            ->select('formulir_ppdb_1.*', 'formulir_ppdb_2.*', 'formulir_ppdb_3.*', 'formulir_ppdb_4.*', 'formulir_ppdb_5.*', 'periode_pendidikan.*')
        ->where('formulir_ppdb_1.user_id', '=', $calon_peserta)
            ->first();
        $file = Uploud_File::where('user_id', '=', $calon_peserta)
        ->select('user_id', 'file_type', 'status_pendaftaran', 'catatan', 'file_path')
        ->get();
        $filefoto = Uploud_File::where('user_id', '=', $calon_peserta)
        ->select('user_id', 'file_type', 'status_pendaftaran', 'catatan', 'file_path')
            ->where('file_type', 'foto')
        ->first(); // Use first() if only one result is expected
        // $imagePath = storage_path('app/public/' . $filefoto->file_path);
        if ($filefoto && $filefoto->file_path) {
            $imagePath = storage_path('app/public/' . $filefoto->file_path);
        } else {
            $imagePath = public_path('app/images/check.png'); // Path ke gambar default
        }



        // Ensure that the file was found
        // if (!$filefoto) {
        //     return response()->json(['error' => 'File not found'], 404);
        // }

        // Get the image path from the file's file_path column
        $imagePath = storage_path('app/public/' . $filefoto->file_path);
        \Carbon\Carbon::setLocale('id');
        // $tanggalLahir = Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y');
        $tanggalLahir = optional($data)->tanggal_lahir
        ? Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y')
        : 'Tanggal lahir tidak tersedia';

        $tanggalCetak = Carbon::parse(now())->translatedFormat('d F Y');
        $pdf = Pdf::loadView('administrator.ppdb.pdf.pdf', [
            'data' => $data,
            'file' => $file,
            'imagePath' => $imagePath,
            'bulanRomawi' => $bulanRomawi,
            'tahun' => $tahun,
            'tanggalLahir' => $tanggalLahir,
            'tanggalCetak' => $tanggalCetak,
            'periode_pendidikan_id' => $periode_pendidikan_id
        ]);

        // Set F4 paper size (210mm x 330mm) and orientation to portrait
        $pdf->setPaper([0, 0, 210, 330], 'portrait');
        // return $pdf->stream('contoh.pdf',$data->full_name); // Unduh file PDF
        return $pdf->stream('surat pernyataan - ' . ($data ? $data->nama_lengkap : 'Tanpa Nama') . '.pdf');

    }


    public function DaftarCalonPesertaValid()
    {
        // dd($calon_peserta);
        
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;
        // $tanggalCetak = Carbon::now();
        // Case untuk bulan ke romawi
        $bulanRomawi = match ($bulan) {
            1 => 'I',  // Januari
            2 => 'II', // Februari
            3 => 'III', // Maret
            4 => 'IV', // April
            5 => 'V',  // Mei
            6 => 'VI', // Juni
            7 => 'VII', // Juli
            8 => 'VIII', // Agustus
            9 => 'IX',  // September
            10 => 'X',  // Oktober
            11 => 'XI', // November
            12 => 'XII', // Desember
            default => null,
        };
        // $user_id = Auth::id();
        $dataCalon = Formulir_ppdb_1::query()
            ->join('periode_pendidikan', 'formulir_ppdb_1.periode_pendidikan_id', '=', 'periode_pendidikan.id')
            ->join('formulir_ppdb_2', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_2.user_id')
            ->join('formulir_ppdb_3', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_3.user_id')
            ->join('formulir_ppdb_4', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_4.user_id')
            ->join('formulir_ppdb_5', 'formulir_ppdb_1.user_id', '=', 'formulir_ppdb_5.user_id')
            ->where('formulir_ppdb_1.periode_pendidikan_id', session('periode_id'))
            ->where('formulir_ppdb_1.status_pendaftaran', '=', 'disetujui')
            ->where('formulir_ppdb_2.status_pendaftaran', '=', 'disetujui')
            ->where('formulir_ppdb_3.status_pendaftaran', '=', 'disetujui')
            ->where('formulir_ppdb_4.status_pendaftaran', '=', 'disetujui')
            ->where('formulir_ppdb_5.status_pendaftaran', '=', 'disetujui')
            ->select([
                'formulir_ppdb_1.*',
                'periode_pendidikan.periode',
                'periode_pendidikan.semester',
                'formulir_ppdb_1.created_at',
                'formulir_ppdb_1.nama_lengkap',
                'formulir_ppdb_1.status_pendaftaran as status_1',
                'formulir_ppdb_2.status_pendaftaran as status_2',
                'formulir_ppdb_3.status_pendaftaran as status_3',
            'formulir_ppdb_4.status_pendaftaran as status_4',
            'formulir_ppdb_5.status_pendaftaran as status_5',
            'jenjang'
            ])
            ->get();

        $pdf = Pdf::loadView('administrator.ppdb.pdf.valid', [
            'dataCalon' => $dataCalon,
            'bulanRomawi' => $bulanRomawi,
            'tahun' => $tahun,
            // 'tanggalLahir' => $tanggalLahir,
            // 'tanggalCetak' => $tanggalCetak,
            
        ]);

        // Set F4 paper size (210mm x 330mm) and orientation to portrait
        $pdf->setPaper([0, 0, 210, 330], 'portrait');
        // return $pdf->stream('contoh.pdf',$dataCalon->full_name); // Unduh file PDF
        return $pdf->stream('surat pernyataan - '  . '.pdf');
    }
    public function HapusFormulir($user_id = null)
    {
        // Retrieve records based on the provided user_id
        $formulir1 = Formulir_ppdb_1::where('user_id', $user_id)->first();
        $formulir2 = Formulir_ppdb_2::where('user_id', $user_id)->first();
        $formulir3 = Formulir_ppdb_3::where('user_id', $user_id)->first();
        $formulir4 = Formulir_ppdb_4::where('user_id', $user_id)->first();
        $formulir5 = Formulir_ppdb_5::where('user_id', $user_id)->first();
        // Check if each record exists before attempting to delete
        if ($formulir1) {
            $formulir1->delete();
        }
        if ($formulir2) {
            $formulir2->delete();
        }
        if ($formulir3) {
            $formulir3->delete();
        }
        if ($formulir4) {
            $formulir4->delete();
        }
        if ($formulir5) {
            $formulir5->delete();
        }


        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
























}
