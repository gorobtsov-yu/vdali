<?php

namespace Database\Seeders\Tests\TestBases;

class HelpTestBaseSeeder extends TestBaseSeeder
{
    private $bases = [
        [
            'name' => '',
            'code' => ''
        ],
    ];

    public function __construct()
    {
        return parent::__construct('help');
    }

    public function run(): void
    {
        $this->setBases($this->bases);
    }
}
