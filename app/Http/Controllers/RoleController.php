<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json(['roles'=>$roles], 200);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:roles|max:255',
        ]);
        $role = Role::create([
            'name'=> $request->name,
        ]);
        return response()->json(['role'=>$role ,'message'=>'Role Created Successfully'], 201);
    }
    
    public function show(Role $role)
    {
        return response()->json(['role'=> $role], 201); // Returns role data
    }

    public function update(Request $request, Role $role)
    {
        $role->name = $request->name;
        $role->email = $request->email;
        $role->password = bcrypt($request->password);
        $role->save();

        return response()->json(['message' => 'Role Updated'], 200);
    }

    public function destroy(Role $role)
    {
        $role->delete(); // Deletes the role
        return response()->json(['message' => 'Role deleted'], 201);
    }
}
