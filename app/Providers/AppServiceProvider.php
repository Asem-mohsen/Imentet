<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\Museum\NavbarService;

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
        View::composer('layout.navbar.gem-navbar', function ($view) {
            $navbarService = app(NavbarService::class);
            $view->with('data', $navbarService->getNavbarData());
        });
    
    }
}
