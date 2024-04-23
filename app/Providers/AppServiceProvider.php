<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app('url')->forceRootUrl(env('APP_URL'));
        if (Str::contains(env('APP_URL'), 'https://')) {
            app('url')->forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
