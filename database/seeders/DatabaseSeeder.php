<?php

namespace Database\Seeders;

use Database\Seeders\Core\ActivityTypeSeeder;
use Database\Seeders\Core\CharacteristicSeeder;
use Database\Seeders\Core\EducationLevelSeeder;
use Database\Seeders\Core\EducationSphereSeeder;
use Database\Seeders\Core\EmploymentSeeder;
use Database\Seeders\Core\OpenQuestionSeeder;
use Database\Seeders\Core\RolesAndPermissionsSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\Relations\ActivityTypeCharacteristicSeeder;
use Database\Seeders\Relations\ActivityTypeTestBaseSeeder;
use Database\Seeders\Relations\EmploymentActivityTypeSeeder;
use Database\Seeders\Relations\EmploymentEductaionLevelSeeder;
use Database\Seeders\Relations\EmploymentEductaionSphereSeeder;
use Database\Seeders\Tests\TestBaseSeeder;
use Database\Seeders\Tests\TestSeeder;
use Database\Seeders\TestsData\TestAnswerSeeder;
use Database\Seeders\TestsData\TestQuestionSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * Core.
         */
        $this->call([
            RolesAndPermissionsSeeder::class,
            ActivityTypeSeeder::class,
            CharacteristicSeeder::class,
            EmploymentSeeder::class,
            OpenQuestionSeeder::class,
            EducationLevelSeeder::class,
            EducationSphereSeeder::class,
        ]);

        /**
         * Common.
         */
        $this->call([
            UserSeeder::class,
            VacancySeeder::class,
        ]);

        /**
         * Tests.
         */
        $this->call([
            TestSeeder::class,
            TestBaseSeeder::class,
        ]);

        /**
         * Tests data.
         */
        $this->call([
            TestQuestionSeeder::class,
            TestAnswerSeeder::class,
        ]);

        /**
         * Relations.
         */
        $this->call([
            EmploymentActivityTypeSeeder::class,
            ActivityTypeCharacteristicSeeder::class,
            ActivityTypeTestBaseSeeder::class,
            EmploymentEductaionLevelSeeder::class,
            EmploymentEductaionSphereSeeder::class,
        ]);
    }
}
