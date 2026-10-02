<?php

namespace Database\Seeders\Core;

use App\Models\OpenQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpenQuestionSeeder extends Seeder
{
    private array $openQuestions = [
        'Опишите занятие, которое может увлечь вас настолько, что вы теряете счет времени. Что в нем особенного?',
        'Если бы у вас был свободный год и полная финансовая свобода, чем бы вы хотели заниматься? Почему?',
        'Какие школьные предметы или темы вызывали у вас наибольший интерес? Что именно вас в них привлекало?',
        'Вспомните момент, когда вы чувствовали, что делаете что-то по-настоящему важное. Что это было?',
        'Опишите человека, на которого вы хотели бы быть похожим в профессиональном плане. Какие его качества вас привлекают?',
        'Какие три ваши личные качества больше всего помогают вам в жизни? А какие мешают?',
    ];

    public function run(): void
    {
        foreach ($this->openQuestions as $openQuestion) {
            OpenQuestion::create([
                'text' => $openQuestion,
            ]);
        }
    }
}
