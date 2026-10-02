<?php

namespace Database\Seeders\Relations\ActivityTypeTestBase;

class KlimovActivityTypeTestBaseSeeder extends ActivityTypeTestBaseSeeder
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
            'man_man',
        ],
        'creative' => [
            'man_art',
        ],
        'social-communicative' => [
            'man_man',
        ],
        'analytical' => [
            'man_sign',
            'man_technics',
            'man_nature',
        ],
    ];

    public function run(): void
    {
        $this->setActivityTypeTestBase($this->activityTypeTestBase);
    }
}
