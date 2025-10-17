<?php

namespace App\Providers;

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
        // Directive to check if the user has the specified role type
        Blade::if('roletype', function (string $type) {
            return auth()->check() && auth()->user()->hasRoleType($type);
        });

        // Directive to check if the user has any of the given role types
        Blade::if('roletypes', function (array $types) {
            return auth()->check() && auth()->user()->hasAnyRoleType($types);
        });
    }
}
