<?php

namespace Database\Seeders\Core;

use App\Models\ActivityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    private $activityTypes = [
        [
            'name' => 'Организационный',
            'code' => 'organizational',
        ],
        [
            'name' => 'Творческий',
            'code' => 'creative',
        ],
        [
            'name' => 'Социально-коммуникативный',
            'code' => 'social-communicative',
        ],
        [
            'name' => 'Аналитический',
            'code' => 'analytical',
        ],
    ];

    public function run(): void
    {
        foreach ($this->activityTypes as $activityType) {
            ActivityType::firstOrCreate(
                ['code' => $activityType['code']],
                $activityType,
            );
        }
    }
}
