<?php

namespace Database\Seeders\TestsData;

use App\Models\Test;
use App\Models\TestQuestion;
use Database\Seeders\TestsData\TestQuestions\KlimovTestQuestionSeeder;
use Database\Seeders\TestsData\TestQuestions\YovayshiTestQuestionSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            KlimovTestQuestionSeeder::class,
            YovayshiTestQuestionSeeder::class,
        ]);
    }
}
