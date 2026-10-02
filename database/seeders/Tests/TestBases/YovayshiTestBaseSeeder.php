<?php

namespace Database\Seeders\Tests\TestBases;

use App\Models\Test;

class YovayshiTestBaseSeeder extends TestBaseSeeder
{
    private $bases = [
        [
            'name' => 'Сфера искусства',
            'code' => 'art_sphere'
        ],
        [
            'name' => 'Сфера технических интересов',
            'code' => 'tech_sphere'
        ],
        [
            'name' => 'Сфера работы с людьм',
            'code' => 'people_sphere',
        ],
        [
            'name' => 'Сфера умственного труда',
            'code' => 'mental_sphere',
        ],
        [
            'name' => 'Сфера физического труда',
            'code' => 'physical_sphere',
        ],
        [
            'name' => 'Сфера материальных интересов',
            'code' => 'material_sphere',
        ],
    ];

    public function __construct()
    {
        return parent::__construct('yovayshi');
    }

    public function run(): void
    {
        $this->setBases($this->bases);
    }
}
