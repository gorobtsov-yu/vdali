<?php

namespace Database\Seeders\Core;

use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    private array $characteristics = [
        [
            'name' => 'Умный', 
            'code' => 'smart'
        ],
        [
            'name' => 'Энергичный', 
            'code' => 'energetic'
        ],
        [
            'name' => 'Решительный', 
            'code' => 'decisive'
        ],
        [
            'name' => 'Добрый', 
            'code' => 'kind'
        ],
        [
            'name' => 'Общительный', 
            'code' => 'sociable'
        ],
        [
            'name' => 'Ответственный', 
            'code' => 'responsible'
        ],
        [
            'name' => 'Оптимистичный', 
            'code' => 'optimistic'
        ],
        [
            'name' => 'Любопытный', 
            'code' => 'curious'
        ],
        [
            'name' => 'Организованный', 
            'code' => 'organized'
        ],
        [
            'name' => 'Целеустремленный', 
            'code' => 'purposeful'
        ],
    ];
    
    public function run(): void
    {
        foreach ($this->characteristics as $characteristic) {
            Characteristic::firstOrCreate(
                ['code' => $characteristic['code']],
                $characteristic
            );
        }
    }
}
