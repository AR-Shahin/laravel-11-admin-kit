<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function index()  {
        $this->authorize("role-view");
        $roles = Role::whereGuardName("admin")->get();
        return view("admin.role.index",compact('roles'));
    }

    function store(Request $request)  {
        $this->authorize("role-create");
        $request->validate([
            "name" => ["required","string","unique:roles,name"]
        ]);

        Role::create([
            "name" => $request->name,
            "guard_name" => "admin",
        ]);
        $this->successAlert("Role Created!");
        return redirect()->back();
    }

}
