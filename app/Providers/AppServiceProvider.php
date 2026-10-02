<?php

namespace App\Providers;

use App\Services\Core\UserContextService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // if ($this->app->environment('prod')) {
        //     URL::forceScheme('https');
        // }

        $this->app->singleton(UserContextService::class, function ($app) {
            return new UserContextService();
        });
    }   

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
