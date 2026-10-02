<?php

namespace App\Providers;

use App\Contracts\Services\RecommendationServiceContract;
use App\Models\User;
use App\Services\Core\RecommendationService;
use App\Traits\HasUserContext;
use Illuminate\Support\ServiceProvider;

class RecommendationServiceProvider extends ServiceProvider
{
    use HasUserContext;

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            RecommendationServiceContract::class,
            function ($app, $params) {
                
                $user = $params['user'] ?? $this->forCurrentUser()->getUser();

                return new RecommendationService($user);
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
