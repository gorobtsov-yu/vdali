<?php

namespace App\Traits;

use App\Models\User;
use App\Services\Core\UserContextService;
use App\Services\UserService;

trait HasUserContext 
{
    public function forCurrentUser(): UserService 
    {
        return app(UserContextService::class)->forCurrent();
    }

    public function forUserId(int $userId): UserService
    {
        return app(UserContextService::class)->for($userId);
    }

    public function forUser(User $user): UserService
    {
        return app(UserContextService::class)->for($user);
    }
}