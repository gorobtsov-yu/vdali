<?php

namespace Database\Seeders\TestsData\TestQuestions;

use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\TestQuestionGroup;
use Illuminate\Database\Seeder;

abstract class TestQuestionSeeder extends Seeder
{
    protected ?Test $test;

    protected function __construct(string $testCode)
    {
        $this->test = Test::where('code', $testCode)->first();
    }

    protected function setQuestions(array $questions): void
    {
        if (! $this->test) {
            return;
        }

        foreach ($questions as $groups) {
            $group = TestQuestionGroup::create([
                'test_id' => $this->test->id,
            ]);

            foreach ($groups as $num => $question) {
                $testQuestionCode = $this->getCode($group->id, $num);

                TestQuestion::firstOrCreate(
                    [
                        'test_question_group_id' => $group->id,
                        'code' => $testQuestionCode,
                    ],
                    [
                        'text' => $question,
                        'queue_position' => $num,
                    ]
                );
            }
        }
    }

    public function getCode(int $group, int $num): string
    {
        return "{$this->test->code}_q{$group}-{$num}";
    }

    public static function getCodeWithTest(Test $test, TestQuestionGroup $group, int $num): string
    {
        return "{$test->code}_q{$group->id}-{$num}";
    }
}
