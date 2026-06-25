<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        // Share site settings to all views (only if the table exists)
        if (Schema::hasTable('site_settings')) {
            View::share('siteLogo', SiteSetting::get('site_logo'));
            View::share('heroImage', SiteSetting::get('hero_image'));
        }
    }
}
