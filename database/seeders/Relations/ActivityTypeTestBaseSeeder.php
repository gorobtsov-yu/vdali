<?php

namespace Database\Seeders\Relations;

use Database\Seeders\Relations\ActivityTypeTestBase\KlimovActivityTypeTestBaseSeeder;
use Database\Seeders\Relations\ActivityTypeTestBase\YovayshiActivityTypeTestBaseSeeder;
use Illuminate\Database\Seeder;

class ActivityTypeTestBaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KlimovActivityTypeTestBaseSeeder::class,
            YovayshiActivityTypeTestBaseSeeder::class,
        ]);
    }
}
