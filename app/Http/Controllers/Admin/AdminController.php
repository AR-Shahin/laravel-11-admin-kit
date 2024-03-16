<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Exception;
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
                    $html = '<a class="btn btn-sm btn-info " href="'. route("admin.admins.edit",$row["id"]).'"><i class="fa fa-edit"></i></a>
                    ';
                    if($row->roles[0]->name != "Super Admin"){
                      $html .= $this->generateDeleteButton($row,$deleteRoute,"admin-delete");
                    }
                    return $html;

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

    function edit(Admin $admin) {
        $this->authorize("admin-edit");
        $roles = Role::whereGuardName("admin")->get(["id","name"]);
        return view("admin.admin.edit",compact("roles","admin"));
    }
    function store(Request $request)  {
        $this->authorize("admin-create");
        $request->validate([
            "name" => ["required","string"],
            "email" => ["required","string","unique:admins,email"],
            "password" => ["required","confirmed"],
            "role_id" => ["required","exists:roles,id"]
        ]);
        try{
            $admin = new Admin();
            $admin->fill([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password)
            ]);
            $message = "Admin Created!";
            $admin->save();

            $admin->syncRoles(Role::findById($request->role_id));
            $this->successAlert($message);
            return redirect()->route("admin.admins.index");
        }catch(Exception $e){
            $this->logInfo($e->getMessage());
        }
    }
    function update(Request $request,Admin $admin)  {
        $this->authorize("admin-edit");
        $request->validate([
            "name" => ["required","string"],
            "email" => ["required","string","unique:admins,email,$admin->id"],
        ]);
        try{
            $admin->fill([
                "name" => $request->name,
                "email" => $request->email,
            ]);
            $message = "Admin Updated!";
            $admin->save();

            $admin->syncRoles(Role::findById($request->role_id));
            $this->successAlert($message);
            return redirect()->route("admin.admins.index");
        }catch(Exception $e){
            $this->logError($e->getMessage());
        }

    }
    function delete(Admin $admin) {
        $this->authorize("permission-delete");
        $message = "Admin Deleted!";
        try{
            $admin->delete();
            $this->successAlert($message);
            return redirect()->back();
        }catch(Exception $e){
            $this->logError($e->getMessage());
        }
    }
}
