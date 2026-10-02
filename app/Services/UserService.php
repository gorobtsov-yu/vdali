<?php

namespace App\Services;

use App\Contracts\Services\RecommendationServiceContract;
use App\Models\ActivityType;
use App\Models\Test;
use App\Models\User;
use App\Models\UserStatus;
use App\Services\Service;
use Illuminate\Support\Collection;

class UserService extends Service
{
    public function __construct(private User $user)
    { 

    }

    public function getUser(): ?User
    {
        return $this->user;
    }
    
    public function getUserAvaibleTests(): Collection
    {
        $tests = Test::all();

        return TestService::appendTestsExpectedTime($tests);
    }

    public function getUserStatus(): Collection
    {
        $status = $this->user->status
            ->map(function (UserStatus $s) {
                    $activityType = $s->activityType;
            
                    return [
                        'activity_type' => $activityType,
                        'count' => $s->count,
                    ];
                }
            )
            ->sortBy([
                ['count', 'desc'],
            ])
            ->map(fn(array $el)=>$el['activity_type']);
        
        return $status;
    }

    public function getUserTestSessions(): Collection
    {
        $testSessions = $this->user->testSessions;

        return $testSessions;
    }

    public function getUserEmploymentsRecommendation(RecommendationServiceContract $recommendationService, int $depth = 1): Collection
    {
        $employments = EmploymentService::getEmploymentsRecommendation($this->user->activityTypes, $depth);

        return $recommendationService->appendEmploymentMetrics($employments);
    }

    public function getUserActivityType(): ?ActivityType
    {
        $userStatus = $this->user->status
            ->sortByDesc(function ($status) {
                return $status->count;
            })
            ->first();

        if ($userStatus) return $userStatus->activityType;

        return null;
    }

    public function resetUserProgress(): void
    {
        $testSessions = $this->user->sessions;
        $statuses = $this->user->status;

        if ($testSessions) {
            foreach ($testSessions as $session) {
                $session->delete();
            }
        }

        if ($statuses) {
            foreach ($statuses as $status) {
                $status->delete();
            }
        }
    }
}
