<?php

namespace Database\Seeders\Core;

use App\Models\EducationSphere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSphereSeeder extends Seeder
{
    private array $educationSpheres = [
        [
            'name' => 'Фундаментальные и естественные науки',
            'code' => 'fundamental'
        ],
        [
            'name' => 'Инженерия, технологии и промышленность',
            'code' => 'technological'
        ],
        [
            'name' => 'Информационные технологии, кибернетика и безопасность',
            'code' => 'it'
        ],
        [
            'name' => 'Здравоохранение и медицина',
            'code' => 'medical'
        ],
        [
            'name' => 'Аграрный сектор, экология и безопасность жизнедеятельности',
            'code' => 'ecological'
        ],
        [
            'name' => 'Социально-гуманитарные и педагогические науки',
            'code' => 'social'
        ],
        [
            'name' => 'Экономика, управление, право и сервис',
            'code' => 'economical'
        ],
        [
            'name' => 'Искусство, физическая культура и творчество',
            'code' => 'creative'
        ],
        [
            'name' => 'Специальные и междисциплинарные технические направления',
            'code' => 'technological_narrow'
        ],
    ];

    public function run(): void
    {
        foreach ($this->educationSpheres as $educationSphere) {
            EducationSphere::firstOrCreate($educationSphere);
        }
    }
}
