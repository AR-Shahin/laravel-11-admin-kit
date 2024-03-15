<?php

namespace App\Http\Controllers;

use App\Helper\Trait\HasAlert;

abstract class Controller
{
    use HasAlert;
    public $admin_permissions;

    function __construct()
    {
        if(auth("admin")->user()){
            $this->admin_permissions = auth("admin")->user()->getAllPermissions()->pluck("name")->toArray();
        }
    }

    function authorize(string $permission) {
        if(auth("admin")->user()){
            if(!in_array($permission,$this->admin_permissions)){
                abort(403);
            }
        }
    }

}
