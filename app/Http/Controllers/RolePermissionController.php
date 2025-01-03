<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index($role)
    {
        $permissions = Permission::all();
        $roles = Role::where('id',$role)->get();
        $hasrole = DB::table('model_has_permissions')
        ->where('model_id', $role)
        ->join('permissions', 'model_has_permissions.permission_id', '=', 'permissions.id') // Join dengan tabel permissions
        ->join('roles', 'model_has_permissions.model_id', '=', 'roles.id') // Join dengan tabel permissions
        ->select('model_has_permissions.*', 'permissions.name as permission_name','roles.name as roles_name') // Pilih kolom yang dibutuhkan
        ->get();
        return view('administrator.role.role-permission.permission-role-management',compact('role','roles', 'permissions', 'hasrole'));
    }
    public function assignPermission(Request $request)
    {
        $exists = DB::table('model_has_permissions')
        ->where('permission_id', $request->permission_id)
        ->where('model_type', 'App\Models\User')
        ->where('model_id', $request->model_id)
        ->exists();

        $exists = DB::table('model_has_permissions')
        ->where('permission_id', $request->permission_id)
        ->where('model_type', 'App\Models\User')
        ->where('model_id', $request->model_id)
        ->exists();

        if (!$exists) {
            DB::table('model_has_permissions')->insert([
                'permission_id' => $request->permission_id,
                'model_type' => 'App\Models\User',
                'model_id' => $request->model_id,
            ]);

            // Tambahkan notifikasi sukses
            session()->flash('success', 'Permission berhasil ditambahkan.');
            return redirect()->back();
        } else {
            // Tambahkan notifikasi bahwa data sudah ada
            session()->flash('error', 'Permission sudah ada untuk pengguna ini.');
            return redirect()->back();
        }
        return redirect()->back()->with('success', 'Role assigned successfully!');
    }

}
