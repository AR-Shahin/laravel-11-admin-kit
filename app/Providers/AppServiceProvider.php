<?php

namespace App\Providers;

use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FacadesView::composer("admin/*",function(View $view){
            if(auth("admin")->user()){
                $view->with("permissions",auth("admin")->user()->getAllPermissions()->pluck("name")->toArray());
            }
        });
    }
}
