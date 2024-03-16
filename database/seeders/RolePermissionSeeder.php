<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::first();
        $view = Role::find(3);
        $permissions = Permission::all();
        $permissionView = Permission::where("name","like","%-view")->get();
        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }
        foreach($permissionView as $permission){
            $view->givePermissionTo($permission);
        }

        $admin = Admin::first();
        $viewer = Admin::find(2);
        $viewer->assignRole($view);
        $admin->assignRole($role);
    }
}
