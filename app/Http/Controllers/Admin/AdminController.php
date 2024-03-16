<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    function index()  {
        $this->authorize("admin-view");
        return view("admin.admin.index");
    }
    function data_table()  {
        $this->authorize("permission-view");
        $admins = Admin::with("roles");

        return DataTables::of($admins)
                ->addIndexColumn()
                ->addColumn("actions",function($row){
                    $deleteRoute = route('admin.admins.delete', $row["id"]);
                    return $this->generateDeleteButton($row,$deleteRoute,"permission-delete");
                })
                ->addColumn("role",function($row){
                    return $row->roles[0]->name;
                })
                ->rawColumns(["actions","role"])
                ->make(true);
    }

    function create() {
        $this->authorize("admin-create");
        $roles = Role::whereGuardName("admin")->get(["id","name"]);
        return view("admin.admin.create",compact("roles"));
    }
    function storeAndUpdate(Request $request,Admin $admin)  {
        $this->authorize("admin-create");
        if(is_null($admin)){

            $request->validate([
                "name" => ["required","string"],
                "email" => ["required","string","unique:admins,email"],
                "password" => ["required","confirmed"],
            ]);
        }else{
            $request->validate([
                "name" => ["required","string"],
                "email" => ["required","string","unique:admins,email"],
                "password" => ["required","confirmed"],
                "role_id" => ["required","exists:roles,id"]
            ]);
        }

        if(!$admin){
            $admin = new Admin();
        }
        $admin->fill([
            "name" => $request->name,
            "email" => $request->name,
            "password" => bcrypt($request->password)
        ]);

        $admin->save();

        $admin->assignRole(Role::findById($request->role_id));
        $this->successAlert("Admin Created!");
        return redirect()->route("admin.admins.index");
    }

    function delete(Admin $admin) {
        $this->authorize("permission-delete");
        $message = "Already Assigned in a Role!";
        if(!$admin->roles()->exists()){
            $admin->delete();
            $message = "Permission Deleted!";
            $this->successAlert($message);
        }else{
            $this->warningAlert($message);
        }

        return redirect()->back();
    }
}
