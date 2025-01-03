<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){

        $permission = Permission::all();
        return view('administrator.permission.permissionmanagement',compact('permission'));
    }
    public function create()
    {
        return view('administrator.permission.create');
    }
    public function store(Request $request)
    {
        if (Permission::where('name', $request->name)->exists()) {
            return response()->json(['message' => 'Data sudah ada'], 400); // Atau gunakan dd('sama');
        } else {
            Permission::create([
                'name' => $request->guard_name,
                // tambahkan atribut lain jika perlu
            ]);

            return redirect()->back();
        }
    }
}
