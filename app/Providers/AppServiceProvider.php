<?php

namespace App\Providers;

use App\View\Components\admin\SideBarComponent;
use App\View\Components\app\CreditCardComponent;
use App\View\Components\app\ErrorsAdminComponent;
use App\View\Components\app\ErrorsComponent;
use App\View\Components\app\ItemListProfileComponent;
use App\View\Components\app\NavBarComponent;
use App\View\Components\app\NavBarCreatorComponent;
use App\View\Components\app\NavBarNoLoggingComponent;
use App\View\Components\app\PostComponent;
use App\View\Components\app\PostGridComponent;
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
        // Configs
        date_default_timezone_set('America/Sao_Paulo');

        // Functions
        require_once app_path('Helpers/helpers.php');

        // Components
        Blade::component('post-component', PostComponent::class);
        Blade::component('navbar-component', NavBarComponent::class);
        Blade::component('navbar-nologging-component', NavBarNoLoggingComponent::class);
        Blade::component('navbar-creator-component', NavBarCreatorComponent::class);
        Blade::component('item-list-profile-component', ItemListProfileComponent::class);
        Blade::component('errors-component', ErrorsComponent::class);
        Blade::component('errors-admin-component', ErrorsAdminComponent::class);
        Blade::component('credit-card-component', CreditCardComponent::class);
        Blade::component('post-grid-component', PostGridComponent::class);
        Blade::component('sidebar-component', SideBarComponent::class);
    }
}
