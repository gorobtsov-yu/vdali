<?php

namespace Database\Seeders\TestsData;

use Database\Seeders\TestsData\TestAnswers\KlimovTestAnswerSeeder;
use Database\Seeders\TestsData\TestAnswers\YovayshiTestAnswerSeeder;
use Illuminate\Database\Seeder;

class TestAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            KlimovTestAnswerSeeder::class,
            YovayshiTestAnswerSeeder::class,
        ]);
    }
}
