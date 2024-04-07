<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function index()  {
        $this->authorize("role-view");
        $roles = Role::whereGuardName("admin")->get();
        return view("admin.role.index",compact('roles'));
    }

    function storeAndUpdate(Request $request,Role $role)  {
        $this->authorize("role-create");
        if(!$role){
            $request->validate([
                "name" => ["required","string","unique:roles,name"]
            ]);
        }

        $message = "Role Updated!";
        if(!$role){
            $role = new Role();
            $message = "Role Created!";
        }
        $role->fill([
            "name" => $request->name,
            "guard_name" => "admin",
        ]);

        $role->save();
        $this->successAlert($message);
        return redirect()->route("admin.roles.index");
    }

    function delete(Role $role) {
        $this->authorize("role-delete");
        $message = "Already Assigned in a Permission!";
        if(!$role->permissions()->exists()){
            $role->delete();
            $message = "Role Deleted!";
            $this->successAlert($message);
        }else{
            $this->warningAlert($message);
        }

        return redirect()->back();
    }
    function assignPermission(Role $role) {
        $permissions = Permission::whereGuardName("admin")->orderBy("name")->get();
        $alreadyGiven = $role->permissions()->pluck("id")->toArray();

        $permissionArrays = [
            'view' => [],
            'create' => [],
            'edit' => [],
            'delete' => [],
            'other' => []
        ];

        foreach ($permissions as $item) {
            $permissionType = 'other';
            if (strpos($item->name, 'view') !== false) {
                $permissionType = 'view';
            } elseif (strpos($item->name, 'create') !== false) {
                $permissionType = 'create';
            } elseif (strpos($item->name, 'edit') !== false) {
                $permissionType = 'edit';
            } elseif (strpos($item->name, 'delete') !== false) {
                $permissionType = 'delete';
            }

            $permissionArrays[$permissionType][] = [
                'id' => $item->id,
                'name' => ucwords(str_replace("-", " ", $item->name))
            ];
        }

        return view("admin.role.assign-permission",compact("permissionArrays","role","alreadyGiven"));
    }
    function assignPermissionStore(Request $request,Role $role)  {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);


        $permissions = Permission::whereIn("id",is_null($request->permissions) ? [] : $request->permissions)->get();
        $role->syncPermissions($permissions);
        $this->successAlert("Assigned Permission to this Role.");
        return redirect()->back();
    }

}
