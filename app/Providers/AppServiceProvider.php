<?php

namespace App\Providers;

use App\View\Components\app\ItemListProfileComponent;
use App\View\Components\app\NavBarComponent;
use App\View\Components\app\NavBarCreatorComponent;
use App\View\Components\app\PostComponent;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('post-component', PostComponent::class);
        Blade::component('navbar-component', NavBarComponent::class);
        Blade::component('navbar-creator-component', NavBarCreatorComponent::class);
        Blade::component('item-list-profile-component', ItemListProfileComponent::class);
    }
}
