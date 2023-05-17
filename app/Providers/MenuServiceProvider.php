<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer(
            ['layout.*'],
            function ($view) {
                $navMenus = Menu::query()
                    ->orderBy('name',"ASC")
                    ->get();
                $view->with([
                    'navMenus' => $navMenus
                ]);
            }
        );
    }
}
