<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){

        $roles = Role::all();
        return view('administrator.role.rolemanagement',compact('roles'));
    }
    public function create(){
        return view('administrator.role.create');   
    }
    public function store(Request $request)
    {
        if (Role::where('name', $request->name)->exists()) {
            return response()->json(['message' => 'Data sudah ada'], 400); // Atau gunakan dd('sama');
        } else {
            Role::create([
                'name' => $request->guard_name,
                // tambahkan atribut lain jika perlu
            ]);

            return redirect()->back();
        }
    }
    public function assignRole($userId,Request $request)
    {
        $user = User::findOrFail($userId);
        $roleName = $request->input('role');

        // Ensure the selected role exists
        $role = Role::findByName($roleName);
        $user->syncRoles([$role]); // Use syncRoles to assign the role

        return redirect()->back()->with('success', 'Role assigned successfully!');
    }
}
