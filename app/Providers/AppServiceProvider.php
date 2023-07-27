<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        //
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user_id = Auth::id();
                $menuItems = DB::table('menus')->where('user_id', $user_id)->get();
                $view->with('menuItems', $menuItems);
            }
        });
    }
}
