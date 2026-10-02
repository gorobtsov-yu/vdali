<?php

namespace Database\Seeders\Tests;

use App\Models\Test;
use Database\Seeders\Tests\Tests\KlimovTestSeeder;
use Database\Seeders\Tests\Tests\YovayshiTestSeeder;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KlimovTestSeeder::class,
            YovayshiTestSeeder::class,
        ]);
    }
}
