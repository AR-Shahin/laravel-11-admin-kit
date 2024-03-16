<?php

use App\Http\Controllers\Admin\{
    AdminController,
    DashboardController,
    PermissionController,
    RoleController
};

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware("auth:admin")->name("admin.")->group(function(){
    Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");

    # Role
    Route::prefix('roles')->controller(RoleController::class)->name("roles.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/store/{role?}","storeAndUpdate")->name("store");
        Route::post("delete/{role}","delete")->name("delete");
        Route::get("assign-permissions/{role}","assignPermission")->name("assign_permission");
        Route::post("assign--permissions/{role}","assignPermissionStore")->name("assign__permission");
    });

      # Permission
      Route::prefix('permissions')->controller(PermissionController::class)->name("permissions.")->group(function () {
        Route::get("","index")->name("index");
        Route::get("data_table","data_table")->name("data_table");
        Route::post("store/{permission?}","store")->name("store");
        Route::post("delete/{permission}","delete")->name("delete");
    });



      # Admin
      Route::prefix('admins')->controller(AdminController::class)->name("admins.")->group(function () {
        Route::get("","index")->name("index");
        Route::get("/create","create")->name("create");
        Route::get("data_table","data_table")->name("data_table");
        Route::post("store/{admin?}","storeAndUpdate")->name("store_update");
        Route::post("delete/{admin}","delete")->name("delete");
    });
});
