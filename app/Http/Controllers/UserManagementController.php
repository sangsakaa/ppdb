<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(){
        $dataUser = User::all();
        $roles = Role::all();
        return view('administrator.usermanagement.usermanagement',compact('dataUser', 'roles'));
    }
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6', // Minimum 6 karakter (tetap ada validasi, meskipun password akan di-set default)
        ]);

        // Cari pengguna berdasarkan email
        $user = User::where('email', $validated['email'])->first();

        // Jika pengguna ditemukan, reset passwordnya
        if ($user) {
            // Set password default menjadi '12345678'
            $user->password = Hash::make('12345678');
            $user->save();
            return redirect()->route('user-management')->with('success', 'Password berhasil direset!');
            // return response()->json([
            //     'message' => 'Password berhasil direset!',
            //     'user' => $user
            // ], 200);
        } else {
            return response()->json([
                'message' => 'Pengguna tidak ditemukan!',
            ], 404);
        }
        
    }
}
