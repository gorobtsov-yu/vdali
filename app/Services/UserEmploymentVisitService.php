<?php

namespace App\Services;

use App\Models\Employment;
use App\Models\UserEmploymentVisit;
use App\Traits\HasUserContext;
use Illuminate\Support\Facades\Auth;

class UserEmploymentVisitService extends Service
{
    use HasUserContext;

    public function __construct()
    {
        //
    }

    public function recordVisit(Employment $employment): void
    {
        UserEmploymentVisit::upsert(
            [
                'employment_id' => $employment->id,
                'user_id' => $this->forCurrentUser()->getUser()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            ['employment_id', 'user_id'],
            ['updated_at']
        );
    }
}
