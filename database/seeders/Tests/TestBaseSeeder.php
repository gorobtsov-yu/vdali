<?php

namespace Database\Seeders\Tests;

use Database\Seeders\Tests\TestBases\KlimovTestBaseSeeder;
use Database\Seeders\Tests\TestBases\YovayshiTestBaseSeeder;
use Illuminate\Database\Seeder;

class TestBaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KlimovTestBaseSeeder::class,
            YovayshiTestBaseSeeder::class,
        ]);
    }
}
