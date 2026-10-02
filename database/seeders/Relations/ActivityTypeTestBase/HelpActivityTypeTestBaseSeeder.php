<?php

namespace Database\Seeders\Relations\ActivityTypeTestBase;

class HelpActivityTypeTestBaseSeeder extends ActivityTypeTestBaseSeeder
{
    /**
     * [
     *    Activity type => [
     *       Test base,
     *    ],
     * ]
     */
    private $activityTypeTestBase = [
        '' => [
            '',
        ],
    ];

    public function run(): void
    {
        $this->setActivityTypeTestBase($this->activityTypeTestBase);
    }
}