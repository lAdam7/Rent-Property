<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('verified', function() {
            return auth()->user()->hasVerifiedEmail();
        });

        Gate::define('landlord', function() {
            return auth()->user()->landlord;
        });

        Gate::define('admin', function() {
            return auth()->user()->admin;
        });
    }
}
