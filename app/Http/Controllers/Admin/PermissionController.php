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
        return view("admin.permission.index");
    }
    function data_table()  {
        $this->authorize("permission-view");
        $permissions = Permission::whereGuardName("admin");

        return DataTables::of($permissions)
                ->addIndexColumn()
                ->addColumn("actions",function($row){
                    $deleteRoute = route('admin.permissions.delete', $row["id"]);
                    return $this->generateEditButton($row) . $this->generateDeleteButton($row,$deleteRoute,"permission-delete");
                })
                ->rawColumns(["actions"])
                ->make(true);
        return view("admin.permission.index",compact('permissions'));
    }

    function store(Request $request,Permission $permission)  {
        $this->authorize("permission-create");
        if(!$permission){
            $request->validate([
                "name" => ["required","string","unique:permissions,name"]
            ]);
        }

        if(!$permission){
            $permission = new Permission();
        }
        $permission->fill([
            "name" => $request->name,
            "guard_name" => "admin"
        ]);

        $permission->save();

        $this->successAlert("Permission Created!");
        return redirect()->back();
    }

    function delete(Permission $permission) {
        $this->authorize("permission-delete");
        $message = "Already Assigned in a Role!";
        if(!$permission->roles()->exists()){
            $permission->delete();
            $message = "Permission Deleted!";
            $this->successAlert($message);
        }else{
            $this->warningAlert($message);
        }

        return redirect()->back();
    }
    private function generateEditButton($row){
        return '
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#rowId_'.$row['id'].'">
         <i class="fa fa-edit"></i>
        </button>
        <div class="modal fade" id="rowId_'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="rowId_'.$row['id'].'Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form action="'.route('admin.permissions.store',$row["id"]).'" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="rowId_'.$row['id'].'Label">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value=" '. csrf_token() .'">
                <div class="form-group">
                    <label for=""><b>Name</b></label>
                    <input type="text" class="form-control" name="name" value="'. $row['name'].'">
                </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
          </form>
        </div>
      </div>';

    }


}
