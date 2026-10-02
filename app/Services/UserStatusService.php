<?php

namespace App\Services;

use App\Models\ActivityType;
use App\Models\Test;
use App\Models\TestAnswer;
use App\Models\TestBase;
use App\Models\TestSession;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserStatusService extends Service
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function setTestResultsWithBases(Test $test, Collection $baseResults)
    {
        $testSession = TestSession::create([
            'user_id' => $this->user->id,
            'test_id' => $test->id,
        ]);

        $bases = $baseResults->keys();
        $resultsCount = $test->results_count;
        $userStatuses = $this->user->status;

        for ($i = 0; $i < $resultsCount && $i < $baseResults->count(); $i++) {
            $base = TestBase::with('activityTypes')->where('code', $bases->get($i))->first();

            if (!$base) continue;

            $testSession->bases()->attach($base);

            $baseActivityTypes = $base->activityTypes;

            foreach ($baseActivityTypes as $activityType) {

                /**
                 * Add value if note already exists.
                 * Else create note with value '1'.
                 */

                $isUserStatusChanged = false;

                foreach ($userStatuses as $userStatus) {
                    if ($userStatus->activityType->code == $activityType->code) {
                        $userStatus->count += 1;
                        $userStatus->save();

                        $isUserStatusChanged = true;

                        break;
                    }
                }

                if ($isUserStatusChanged) continue;

                UserStatus::create([
                    'user_id' => $this->user->id,
                    'activity_type_id' => $activityType->id,
                    'count' => 1,
                ]);
            }
        }
    }

    /**
     * [
     *    'activityType' => count
     * ]
     */
    public function setTestResultsWithActivityTypes(Collection $activityTypesResults, ?Test $test = null): void
    {   
        $resultsCount = $test?->results_count ?? 1;
        $userStatuses = $this->user->status;
        $activityTypes = $activityTypesResults->keys();

        for ($i = 0; $i < $resultsCount && $i < $activityTypes->count(); $i++) { 
            $activityType = ActivityType::where('code', $activityTypes->get($i))->first();

            $isUserStatusChanged = false;

            foreach ($userStatuses as $userStatus) {
                if ($userStatus->activityType->code == $activityType->code) {
                    $userStatus->count += 1;
                    $userStatus->save();

                    $isUserStatusChanged = true;

                    break;
                }
            }

            if ($isUserStatusChanged) continue;

            UserStatus::create([
                'user_id' => $this->user->id,
                'activity_type_id' => $activityType->id,
                'count' => 1,
            ]);
        }
    }
}
