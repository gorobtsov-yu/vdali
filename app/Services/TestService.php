<?php

namespace App\Services;

use App\Models\Employment;
use App\Models\Test;
use App\Models\TestAnswer;
use App\Models\TestQuestionGroup;
use App\Models\User;
use Illuminate\Support\Collection;

class TestService extends Service
{
    private Test $test;

    private static int $secondsPerQuestion = 7;

    private static array $fallbackAverageTestQuestionsCount = [
        'associative' => 5,
    ];

    public function __construct(Test $test)
    {
        $this->test = $test;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function getBaseResults(array $testAnswers): Collection
    {
        $answerIds = [];
        array_walk_recursive($testAnswers, function ($value) use (&$answerIds) {
            if (is_numeric($value)) {
                $answerIds[] = (int) $value;
            }
        });

        $answerIds = array_unique(array_filter($answerIds));

        if (empty($answerIds)) {
            return collect();
        }

        $answers = TestAnswer::with('bases')
            ->whereIn('id', $answerIds)
            ->get();

        $baseCodes = $answers->flatMap(function ($answer) {
            return $answer->bases->pluck('code');
        });

        return $baseCodes->countBy()->sortDesc();
    }

    public static function getAssociativeTestPull(User $user, ?int $limit = null): Collection
    {
        $employments = Employment::all()->shuffle();

        $userStatus = $user->status;

        $limit = $limit ?? self::$fallbackAverageTestQuestionsCount['associative'];

        if ($userStatus->first() == null) {
            return $employments->slice(0, $limit);
        }

        $pull = new Collection;

        for ($i = 0; $i < $employments->count() && $pull->count() < $limit; $i++) {
            $employment = $employments->get($i);
            $employmentActivityTypes = $employment->activityTypes;

            foreach ($employmentActivityTypes as $employmentActivityType) {
                if ($userStatus->contains($employmentActivityType)) {
                    $pull->push($employment);

                    break;
                }
            }
        }

        if ($pull->count() < $limit) {
            foreach ($employments as $employment) {
                if (! $pull->contains($employment)) {
                    $pull->push($employment);
                }

                if ($pull->count() >= $limit) {
                    break;
                }
            }
        }

        return $pull;
    }

    /**
     * [
     *    'employment_code1' => 1,
     *    'employment_code2' => 0,
     * ]
     */
    public static function getAssociativeTestResults(array $testAnswers): Collection
    {
        $activityTypes = new Collection;

        foreach ($testAnswers as $employmentCode => $isLiked) {
            $employment = Employment::where('code', $employmentCode)->first();
            $multiple = 1;

            if (! $employment) {
                continue;
            }

            if (! $isLiked) {
                $multiple *= -1;
            }

            $employmentActivityTypes = $employment->activityTypes;

            foreach ($employmentActivityTypes as $employmentActivityType) {
                if ($activityTypes->has($employmentActivityType->code)) {
                    $activityTypes[$employmentActivityType->code] += $multiple;

                    continue;
                }

                $activityTypes->put($employmentActivityType->code, $multiple);
            }
        }

        $activityTypes->sortByDesc(function ($value, $activityTypeCode) {
            return $value;
        });

        return $activityTypes;
    }

    public static function appendTestsExpectedTime(Collection $tests): Collection
    {
        return $tests->map(function (Test $test) {
            $averageTestQuestionsCount = $test->questionGroups
                ->map(function (TestQuestionGroup $tQG) {
                    $tQG->loadCount('questions');

                    return $tQG;
                })
                ->avg(function (TestQuestionGroup $tQG) {
                    return $tQG->questions_count;
                });

            if ($averageTestQuestionsCount < 1) {
                $averageTestQuestionsCount = self::$fallbackAverageTestQuestionsCount[$test->code] ?? 1;
            }

            $test->expected_time = self::$secondsPerQuestion * $averageTestQuestionsCount;

            return $test;
        });
    }
}
