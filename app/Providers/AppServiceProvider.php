<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paksa semua URL asset menggunakan HTTPS di server produksi
        if (app()->environment('production') || !app()->runningInConsole()) {
            URL::forceScheme('https');
        }

        if (!app()->runningInConsole()) {
            if (Schema::hasTable('site_settings')) {
                View::share('siteLogo', SiteSetting::get('site_logo'));
                View::share('heroImage', SiteSetting::get('hero_image'));
            }
        }
    }
}