<?php

namespace Database\Seeders\Tests\Tests;

use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function setTest(array $test): void
    {
        Test::firstOrCreate(
            ['code' => $test['code']],
            $test
        );
    }
}
