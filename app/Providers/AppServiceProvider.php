<?php

namespace App\Providers;

use App\Services\GifService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // This service is stateless. So we bind as a singleton
        $this->app->singleton(GifService::class, function () {
            return new GifService(Config::get('services.giphy.key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
