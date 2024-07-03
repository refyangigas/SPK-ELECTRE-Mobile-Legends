<?php

namespace App\Providers;

use App\Services\ElectreService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ElectreService::class, function ($app) {
            return new ElectreService(request('laning'), request('user_id'));
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
