<?php

namespace App\Actions;

use App\Models\Employment;
use App\Models\UserEmploymentInteraction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class RecordEmploymentViewAction
{
    use AsAction;

    public function handle(Request $request, Employment $employment): void
    {
        $interaction = UserEmploymentInteraction::firstOrNew([
            'user_id' => $request->user()->id,
            'employment_id' => $employment->id,
        ]);

        if (! $interaction->viewed_at || $interaction->viewed_at->diffInSeconds(now()) >= 10) {
            $interaction->viewed_at = now();
            $interaction->save();
        }
    }
}
