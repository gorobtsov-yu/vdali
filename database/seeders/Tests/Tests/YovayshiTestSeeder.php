<?php

namespace Database\Seeders\Tests\Tests;

class YovayshiTestSeeder extends TestSeeder
{
    private $test = [
        'name' => 'Опросник Йовайши',
        'code' => 'yovayshi',
    ];

    public function run(): void
    {
        $this->setTest($this->test);
    }
}
