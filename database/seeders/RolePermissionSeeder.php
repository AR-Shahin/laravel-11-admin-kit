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
        $permissions = Permission::all();
        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }

        $admin = Admin::first();
        $admin->assignRole($role);
    }
}
