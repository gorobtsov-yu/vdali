<?php

namespace App\Services\Core;

use App\Models\User;
use App\Services\Service;
use App\Services\UserService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserContextService extends Service
{
    public function for(int|Authenticatable|User $user): UserService
    {
        $userInstance = $this->resolveUser($user);
        
        return new UserService($userInstance);
    }

    public function forCurrent()
    {
        /**
         * Should be reworked for API auth...
         */

        $user = Auth::user();
        
        if (!$user) {
            throw new AuthenticationException();
        }

        return $this->for($user);
    }

    private function resolveUser($user): User 
    {
        if (is_int($user)) {
            $user = User::findOrFail($user);
        }

        if ($user instanceof Authenticatable) {
            $user = User::findOrFail($user->id);
        }

        return $user;
    }
}
