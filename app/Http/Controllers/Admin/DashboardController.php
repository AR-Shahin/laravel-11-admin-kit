<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()  {
        if(!in_array('role-create', $this->admin_permissions)){
            abort(403);
        }
        return view("admin.dashboard");
    }
}
