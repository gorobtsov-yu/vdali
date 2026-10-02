<?php

namespace Database\Seeders\Tests\Tests;

class KlimovTestSeeder extends TestSeeder
{
    private $test = [
        'name' => 'Тест Климова',
        'code' => 'klimov',
    ];

    public function run(): void
    {
        $this->setTest($this->test);
    }
}
