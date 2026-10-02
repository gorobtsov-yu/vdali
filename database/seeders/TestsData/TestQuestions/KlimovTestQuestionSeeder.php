<?php

namespace Database\Seeders\TestsData\TestQuestions;

class KlimovTestQuestionSeeder extends TestQuestionSeeder
{
    private $questions = [
        [
            1 => 'Мне нравится...',
            2 => 'Мне нравится...',
            3 => 'Мне нравится...',
            4 => 'Мне нравится...',
            5 => 'Мне нравится...',
            6 => 'Мне нравится...',
            7 => 'Мне нравится...',
            8 => 'Мне нравится...',
            9 => 'Мне нравится...',
            10 => 'Мне нравится...',
            11 => 'Мне нравится...',
            12 => 'Мне нравится...',
            13 => 'Мне нравится...',
            14 => 'Мне нравится...',
            15 => 'Мне нравится...',
            16 => 'Мне нравится...',
            17 => 'Мне нравится...',
            18 => 'Мне нравится...',
            19 => 'Мне нравится...',
            20 => 'Мне нравится...',
        ]
    ];

    public function __construct()
    {
        return parent::__construct('klimov');
    }

    public function run(): void
    {
        $this->setQuestions($this->questions);
    }
}
