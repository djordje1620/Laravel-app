<?php

namespace App\Providers;

use App\Models\Information;
use App\Models\Menu;
use App\Models\Social;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        $socials = Social::where('active', '=', 1)->get();
        $menu = Menu::all();
        $informations = Information::all();
        View::share(['menu'=> $menu, 'socials'=>$socials, 'informations'=>$informations]);
    }
}
