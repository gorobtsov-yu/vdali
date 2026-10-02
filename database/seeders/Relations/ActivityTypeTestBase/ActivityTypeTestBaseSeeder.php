<?php

namespace Database\Seeders\Relations\ActivityTypeTestBase;

use App\Models\ActivityType;
use App\Models\TestBase;
use Illuminate\Database\Seeder;

class ActivityTypeTestBaseSeeder extends Seeder
{
    public function setActivityTypeTestBase(array $activityTypeTestBase): void
    {
        foreach ($activityTypeTestBase as $activityTypeCode => $testBases) {
            $activityType = ActivityType::where('code', $activityTypeCode)->first();

            if(!$activityType) continue;

            foreach ($testBases as $testBaseCode) {
                $base = TestBase::where('code', $testBaseCode)->first();

                if(!$base) continue;

                $activityType->bases()->attach($base);
            }
        }
    }
}
