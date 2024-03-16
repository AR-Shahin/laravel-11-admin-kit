<?php

use App\Http\Controllers\Admin\{
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
    });

      # Permission
      Route::prefix('permissions')->controller(PermissionController::class)->name("permissions.")->group(function () {
        Route::get("","index")->name("index");
        Route::get("data_table","data_table")->name("data_table");
        Route::post("store/{permission?}","store")->name("store");
        Route::post("delete/{permission}","delete")->name("delete");
    });
});
