<?php

namespace Database\Seeders\Relations\ActivityTypeTestBase;

class YovayshiActivityTypeTestBaseSeeder extends ActivityTypeTestBaseSeeder
{
    /**
     * [
     *    Activity type => [
     *       Test base,
     *    ],
     * ]
     */
    private $activityTypeTestBase = [
        'organizational' => [
            'people_sphere',
            'mental_sphere',
        ],
        'creative' => [
            'art_sphere',
            'mental_sphere',
        ],
        'social-communicative' => [
            'people_sphere',
            'mental_sphere',
        ],
        'analytical' => [
            'tech_sphere',
            'mental_sphere',
            'material_sphere',
        ],
    ];

    public function run(): void
    {
        $this->setActivityTypeTestBase($this->activityTypeTestBase);
    }
}
