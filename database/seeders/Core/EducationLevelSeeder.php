<?php

namespace Database\Seeders\Core;

use App\Models\EducationLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    private array $educationLevels = [
        [
            'name' => 'Дошкольное образование',
            'code' => 'preschool'
        ],
        [
            'name' => 'Начальное общее образование',
            'code' => 'primary_general'
        ],
        [
            'name' => 'Основное общее образование',
            'code' => 'basic_general'
        ],
        [
            'name' => 'Среднее общее образование',
            'code' => 'secondary_general'
        ],
        [
            'name' => 'Среднее профессиональное образование',
            'code' => 'secondary_vocational'
        ],
        [
            'name' => 'Высшее образование — бакалавриат',
            'code' => 'higher_bachelor'
        ],
        [
            'name' => 'Высшее образование — специалитет, магистратура',
            'code' => 'higher_specialist_master'
        ],
        [
            'name' => 'Высшее образование — подготовка кадров высшей квалификации',
            'code' => 'higher_qualification'
        ]
    ];

    public function run(): void
    {
        foreach ($this->educationLevels as $educationLevel) {
            EducationLevel::firstOrCreate($educationLevel);
        }
    }
}
