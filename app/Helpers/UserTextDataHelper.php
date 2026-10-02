<?php

namespace App\Helpers;

use App\Models\ActivityType;
use App\Models\Characteristic;
use App\Models\Employment;
use App\Models\User;
use App\Models\UserEmploymentVisit;
use App\Traits\HasUserContext;

class UserTextDataHelper
{
    private User $user;

    private string $data = '';

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function forUser(User $user): self
    {
        return new self($user);
    }

    public function get(): string
    {
        return preg_replace('| +|', ' ', $this->data);
    }

    public function getUserTextData(): string
    {
        return $this->appendUserFullName()
            ->appendSpaces()
            ->appendUserActivityTypes()
            ->appendSpaces()
            ->appendUserCharacteristics()
            ->appendSpaces()
            ->appendUserEmploymentHistory()
            ->appendSpaces()
            ->appendUserLastCompletedTest()
            ->appendSpaces()
            ->appendUserDesiredSalary()
            ->get();
    }

    public function appendSpaces(int $count = 1): self
    {
        for ($i = 0; $i < $count; $i++) $this->data .= ' ';
        
        return $this;
    }

    public function appendUserFullName(): self
    {
        $this->data .= 'ФИО пользователя: ' . $this->user->full_name . '.';

        return $this;
    }

    public function appendUserActivityTypes(): self
    {
        $userActivityTypes = $this->user->activityTypes;

        if ($userActivityTypes->count() < 1) return $this;

        $this->data .= 'Типы деятельности пользователя: ';

        $userActivityTypes->each(function (ActivityType $activityType, int $key) {
            if ($key > 0) $this->data .= ', ';

            $this->data .= mb_lcfirst($activityType->name);
        });

        $this->data .= '.';

        return $this;
    }

    public function appendUserCharacteristics(): self
    {
        $userCharacteristics = $this->user->characteristics();

        if ($userCharacteristics->count() < 1) return $this;

        $this->data .= 'Наиболее выраженные характеристики пользователя: ';

        $userCharacteristics->each(function (Characteristic $characteristic, int $key) {
            if ($key > 0) $this->data .= ', ';

            $this->data .= mb_lcfirst($characteristic->name);
        });

        $this->data .= '.';

        return $this;
    }

    public function appendUserEmploymentHistory(int $limit = 5): self
    {
        $employments = Employment::join('user_employment_interactions', 'employments.id', '=', 'user_employment_interactions.employment_id')
            ->where('user_employment_interactions.user_id', $this->user->id)
            ->whereNotNull('user_employment_interactions.viewed_at')
            ->orderBy('user_employment_interactions.viewed_at', 'desc')
            ->limit($limit)
            ->get(['employments.*', 'user_employment_interactions.viewed_at as viewed_at']);

        if ($employments->isEmpty()) {
            return $this;
        }

        $this->data .= 'История просмотра занятостей пользователя: ';

        $employments->each(function ($employment, int $key) {
            if ($key > 0) {
                $this->data .= ', ';
            }
            $this->data .= mb_lcfirst($employment->name);
        });

        $this->data .= '.';

        return $this;
    }

    public function appendUserLastCompletedTest(): self
    {
        $userTestSession = $this->user->testSessions->load(['test', 'bases'])->last();

        if (!$userTestSession) return $this;

        $this->data .= 'Последний пройденный тест пользователем - ' . mb_lcfirst($userTestSession->test->name) . '. ';
        $this->data .= 'Результат последнего пройденного теста - ' . mb_lcfirst($userTestSession->bases->first()->name) . '.';

        return $this;
    }

    public function appendUserDesiredSalary(): self
    {
        if (!$this->user->desired_salary) return $this;

        $this->data .= 'Желаемая пользователем зарплата - ' . $this->user->desired_salary . '₽.';

        return $this;
    }
}
