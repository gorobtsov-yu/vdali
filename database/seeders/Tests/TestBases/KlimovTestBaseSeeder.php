<?php

namespace Database\Seeders\Tests\TestBases;

class KlimovTestBaseSeeder extends TestBaseSeeder
{
    private $bases = [
        [
            'name' => 'Человек-природа',
            'code' => 'man_nature'
        ],
        [
            'name' => 'Человек-техника',
            'code' => 'man_technics'
        ],
        [
            'name' => 'Человек-человек',
            'code' => 'man_man',
        ],
        [
            'name' => 'Человек-знаковая система',
            'code' => 'man_sign',
        ],
        [
            'name' => 'Человек-художественный образ',
            'code' => 'man_art',
        ],
    ];

    public function __construct()
    {
        return parent::__construct('klimov');
    }

    public function run(): void
    {
        $this->setBases($this->bases);
    }
}
