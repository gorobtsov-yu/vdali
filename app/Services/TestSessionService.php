<?php

namespace App\Services;

use App\Models\TestSession;
use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TestSessionService extends Service
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
