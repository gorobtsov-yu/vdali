<?php

namespace App\Providers;

use App\Contracts\Services\GigaChatServiceContract;
use App\Services\GigaChatService;
use Illuminate\Support\ServiceProvider;

class GigaChatServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(GigaChatServiceContract::class, GigaChatService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
