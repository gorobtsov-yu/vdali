<?php

namespace Database\Seeders\TestsData\TestAnswers;

use App\Models\Test;
use App\Models\TestAnswer;
use App\Models\TestQuestionGroup;
use Database\Seeders\TestsData\TestQuestions\TestQuestionSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

abstract class TestAnswerSeeder extends Seeder
{
    protected Test $test;

    protected Collection $questions;

    protected Collection $bases;

    protected function __construct(string $testCode)
    {
        $this->test = Test::where('code', $testCode)->first();
        $this->questions = $this->test->questions;
        $this->bases = $this->test->bases;
    }

    protected function setAnswers(array $answers): void
    {
        if (! $this->test) {
            return;
        }

        if (! $this->questions->first()) {
            return;
        }

        if (! $this->bases->first()) {
            return;
        }

        foreach ($answers as $groupNum => $items) {
            foreach ($items as $num => $qAnswers) {
                foreach ($qAnswers as $answer) {

                    $group = TestQuestionGroup::where([
                        'test_id' => $this->test->id,
                    ])->get()->slice($groupNum, 1)->first();

                    $qCode = TestQuestionSeeder::getCodeWithTest($this->test, $group, $num);

                    $question = $this->questions->where('code', $qCode)->first();

                    if (! $question) {
                        return;
                    }

                    $hash = $this->getAnswerHash($answer);

                    $ans = TestAnswer::firstOrCreate(
                        [
                            'test_question_id' => $question->id,
                            'hash' => $hash,
                        ],
                        [
                            'text' => $answer['text'],
                        ]
                    );

                    foreach ($answer['test_base_codes'] as $testBaseCode) {
                        $base = $this->bases->where('code', $testBaseCode)->first();

                        if (! $base) {
                            continue;
                        }

                        $ans->bases()->attach($base);
                    }
                }
            }
        }
    }

    private function getAnswerHash(array $answer): string
    {
        return md5($answer['text']);
    }
}
