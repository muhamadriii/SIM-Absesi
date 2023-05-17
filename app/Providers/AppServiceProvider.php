<?php

namespace App\Providers;

use App\Models\Menu;
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
        view()->composer(
            ['layouts.*'],
            function ($view) {
                $menus = Menu::query()
                    ->orderBy('name',"ASC")
                    ->get();
                    dd($menus);
                $view->with([
                    'menus' => $menus
                ]);
            }
        );
    }
}
