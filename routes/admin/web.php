<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware("auth:admin")->name("admin.")->group(function(){
    Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");

    # Role
    Route::prefix('roles')->controller(RoleController::class)->name("roles.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("","store")->name("store");
    });
});
