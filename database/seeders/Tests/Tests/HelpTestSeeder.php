<?php

namespace Database\Seeders\Tests\Tests;

class HelpTestSeeder extends TestSeeder
{
    private $test = [
        'name' => '',
        'code' => 'help',
    ];

    public function run(): void
    {
        $this->setTest($this->test);
    }
}