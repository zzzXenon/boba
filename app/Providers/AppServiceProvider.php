<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use App\Policies\RolePolicy;
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
        Gate::define('access-ortu', [RolePolicy::class, 'accessOrtu']);
        Gate::define('access-dosen', [RolePolicy::class, 'accessDosen']);
        Gate::define('access-admin', [RolePolicy::class, 'accessAdmin']);
        Gate::define('access-kemkem', [RolePolicy::class, 'accessKemKem']);
        Blade::directive('favicon', function () {
            return '<link rel="icon" href="' . asset('img/icon.ico') . '" type="image/x-icon">';
    });
    }
}
