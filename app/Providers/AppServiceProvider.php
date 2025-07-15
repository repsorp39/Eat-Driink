<?php

namespace App\Providers;

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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
        //blades directives
        Blade::if("standwaiting", function(){
            return Auth::check() && Auth::user()->isWaitingStand();
        });

        Blade::if("admin",function(){
             return Auth::check() && Auth::user()->isAdmin();
        });

        Blade::if("notadmin",function(){
             return !Auth::check() ||  (Auth::check() && !Auth::user()->isAdmin());
        });

        Blade::if("approved",function(){
             return  (Auth::check() && Auth::user()->isApproved());
        });

        //gates
        Gate::define("add-product",[ProductController::class,"canAdd"]);
        Gate::define("can-update-product",[ProductController::class,"canUpdate"]);
    }
}
