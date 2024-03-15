<?php

namespace App\Http\Controllers;

use App\Helper\Trait\HasAlert;

abstract class Controller
{
    use HasAlert;
    public $admin_permissions;

    function __construct()
    {
        $this->admin_permissions = auth("admin")->user()->getAllPermissions()->pluck("name")->toArray();
    }

}
