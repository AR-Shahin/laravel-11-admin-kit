<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
class PermissionController extends Controller
{
    function index()  {
        $this->authorize("permission-view");
       // $permissions = Permission::whereGuardName("admin")->get();
        return view("admin.permission.index");
    }
    function data_table()  {
        $this->authorize("permission-view");
        $permissions = Permission::whereGuardName("admin");

        return DataTables::of($permissions)
                ->addIndexColumn()
                ->addColumn("actions",function($row){
                    return '<a href="" class="btn btn-sm btn-success mx-1"><i class="fa fa-eye"></i></a>';
                })
                ->rawColumns(["actions"])
                ->make(true);
        return view("admin.permission.index",compact('permissions'));
    }

    function store(Request $request)  {
        $this->authorize("permission-create");
        $request->validate([
            "name" => ["required","string","unique:permissions,name"]
        ]);

        Permission::create([
            "name" => $request->name,
            "guard_name" => "admin",
        ]);
        $this->successAlert("Permission Created!");
        return redirect()->back();
    }
}
