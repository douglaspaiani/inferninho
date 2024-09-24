<?php

namespace App\Providers;

use App\View\Components\app\CreditCardComponent;
use App\View\Components\app\ErrorsComponent;
use App\View\Components\app\ItemListProfileComponent;
use App\View\Components\app\NavBarComponent;
use App\View\Components\app\NavBarCreatorComponent;
use App\View\Components\app\PostComponent;
use App\View\Components\app\PostGridComponent;
use Carbon\Carbon;
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
        date_default_timezone_set('America/Sao_Paulo');
        Blade::component('post-component', PostComponent::class);
        Blade::component('navbar-component', NavBarComponent::class);
        Blade::component('navbar-creator-component', NavBarCreatorComponent::class);
        Blade::component('item-list-profile-component', ItemListProfileComponent::class);
        Blade::component('errors-component', ErrorsComponent::class);
        Blade::component('credit-card-component', CreditCardComponent::class);
        Blade::component('post-grid-component', PostGridComponent::class);
    }
}
