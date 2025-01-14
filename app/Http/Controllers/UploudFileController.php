<?php

namespace App\Http\Controllers;

use App\Models\Uploud_File;
use App\Models\Formulir_ppdb_1;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RdKafkaCaster;

class UploudFileController extends Controller
{
    public function Uploud_File(Request $request, $formulir_ppdb_1 = null)
    {
        $fileType = ['kk', 'ktp', 'akte', 'ijazah', 'ktp_ibu'];
        $dataDokument = Uploud_File::where('user_id', $formulir_ppdb_1)->get();
        $form1 = Formulir_ppdb_1::where('user_id', $formulir_ppdb_1)->first();
        return view(
            'administrator.ppdb.uploud_file',
            [
                'formulir_ppdb_1' => $formulir_ppdb_1,
                'form1' => $form1,
                'dataDokument' => $dataDokument,
                'fileType' => $fileType
            ]
        );
    }
    public function store(Request $request, $formulir_ppdb_1 = null)
    {
        $form1 = Formulir_ppdb_1::where('user_id', $formulir_ppdb_1)->first(); // Ensure you have the correct user ID

        $validated = $request->validate([
            'file_path' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', // Make sure a file is uploaded
            'file_type' => 'required|string', // File type should be provided
            'formulir_ppdb_1_id' => 'required|exists:formulir_ppdb_1,id', // Ensure formulir_ppdb_1_id exists in the database
        ]);

        // Get the uploaded file and other inputs
        $file = $request->file('file_path');
        $fileType = $request->input('file_type');
        $formulir_ppdb_1_id = $form1->id; // Use the ID from the $form1 model

        // Check if a file of this type already exists for the same user_id
        $existingFile = Uploud_File::where('user_id', $form1->user_id)
            ->where('file_type', $fileType)
            ->first();

        if ($existingFile) {
            return redirect()->back()->withErrors(['file_type' => 'You have already uploaded a file of this type.']);
        }

        // Save the file to the public/uploads directory
        $filePath = $file->store($form1->nama_lengkap, 'public');

        // Create a new entry in the uploud_files_ppdb table
        $fileUpload = Uploud_File::create([
            'user_id' => $form1->user_id, // Use the correct user ID from the Formulir_ppdb_1 model
            'formulir_ppdb_1_id' => $formulir_ppdb_1_id, // Ensure you're passing the correct formulir_ppdb_1 ID
            'file_type' => $fileType,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(), // Original file name
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Return a success response
        // return response()->json([
        //     'success' => true,
        //     'message' => 'File uploaded successfully.',
        //     'data' => $fileUpload
        // ]);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
    public function updateStatusDokumen(Request $request, $formulir_ppdb_1 = null)
    {
        $validated = $request->validate([
            'status_pendaftaran' => 'required|in:disetujui,ditolak,menunggu', // Validasi status yang diizinkan
            'user_id' => 'required|integer|exists:formulir_ppdb_1,user_id', // Pastikan user_id ada di database
            'file_type' => 'required|string' // Pastikan file_type dikirimkan dan berupa string
        ]);

        // Ambil nilai dari form
        $status_pendaftaran = $validated['status_pendaftaran'];
        $user_id = $validated['user_id'];
        $file_type = $validated['file_type'];

        // Query untuk memperbarui status berdasarkan user_id dan file_type
        $ppdbForm = Uploud_File::where('user_id', $user_id)
            ->where('file_type', $file_type)
            ->first();

        // Jika data ditemukan, update status
        if ($ppdbForm) {
            $ppdbForm->status_pendaftaran = $status_pendaftaran;

            // Update kolom catatan berdasarkan status_pendaftaran
            if (
                strtolower($status_pendaftaran) === 'disetujui'
            ) {
                $ppdbForm->catatan = 'Ok sudah valid';
                $alertType = 'success';
            } elseif (strtolower($status_pendaftaran) === 'ditolak') {
                $ppdbForm->catatan = 'Masih ada kesalahan';
                $alertType = 'danger';
            } elseif (
                strtolower($status_pendaftaran) === 'menunggu'
            ) {
                $ppdbForm->catatan = 'Masih dalam antrian';
                $alertType = 'warning';
            }

            $ppdbForm->save(); // Simpan perubahan

            return redirect()->back()->with($alertType, 'Status berhasil diperbarui!');
        }
        return redirect()->back()->with('error', 'User tidak ditemukan.');
    }
}
