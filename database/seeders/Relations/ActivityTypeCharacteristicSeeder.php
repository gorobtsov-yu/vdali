<?php

namespace Database\Seeders\Relations;

use App\Models\ActivityType;
use App\Models\Characteristic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityTypeCharacteristicSeeder extends Seeder
{
    private $activityTypeCharacteristic = [
        'organizational' => ['organized', 'responsible', 'decisive'],
        'creative' => ['curious', 'energetic', 'optimistic'],
        'social-communicative' => ['sociable', 'kind', 'energetic'],
        'analytical' => ['smart', 'purposeful', 'responsible']
    ];

    public function run(): void
    {
        foreach ($this->activityTypeCharacteristic as $activityTypeCode => $characteristics) {
            $activityType = ActivityType::where('code', $activityTypeCode)->first();

            if(!$activityType) continue;

            foreach ($characteristics as $characteristicCode) {
                $activityType->characteristics()->attach(Characteristic::where('code', $characteristicCode)->first());
            }
        }
    }
}
