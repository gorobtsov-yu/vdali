<?php

namespace App\Services\Core;

use App\Contracts\Services\RecommendationServiceContract;
use App\Entities\UserRecommendationsMetrics\UserEmploymentRecommendationMetric;
use App\Models\Employment;
use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Collection;

class RecommendationService extends Service implements RecommendationServiceContract
{
    public function __construct(private User $user)
    {
        
    }

    /**
     * 2 factors: characteristics, salary.
     */
    public function appendEmploymentMetrics(Employment|Collection $data, bool $sort = true): Employment|Collection
    {
        $characteristicRecommendationLimit = config('recommendations.employments.settings.characteristics_limit');

        $userCharacteristics = $this->user->characteristics($characteristicRecommendationLimit);

        if ($data instanceof Employment) {
            $data->user_recommendation_metrics = $this->calculateEmploymentMetrics(
                $data,
                $userCharacteristics,
                $characteristicRecommendationLimit
            );

            return $data;
        } else {
            $data->map(function (Employment $employment) use ($userCharacteristics, $characteristicRecommendationLimit) {
                /**
                 * Apped metrics to employment model.
                 */
                $employment->user_recommendation_metrics = $this->calculateEmploymentMetrics(
                    $employment,
                    $userCharacteristics,
                    $characteristicRecommendationLimit
                );
            });
        }
        
        if ($sort) {
            return $data->sortByDesc(function ($employment) {
                return $employment->user_recommendation_metrics->total;
            });
        }

        return $data;
    }

    private function calculateEmploymentMetrics(
        Employment $employment,
        Collection $userCharacteristics,
        int $characteristicRecommendationLimit,
    ): ?UserEmploymentRecommendationMetric
    {
        /**
         * Characteristics logic.
         */
        $employmentCharacteristics = $employment->characteristics($characteristicRecommendationLimit);

        $sameCharacteristics = collect([]);

        $userCharacteristics->each(function ($userCharacteristic) use ($sameCharacteristics, $employmentCharacteristics) {
            if ($employmentCharacteristics
                    ->contains(function($employmentCharacteristic) use ($userCharacteristic) {
                        return $employmentCharacteristic->code == $userCharacteristic->code;
                    }) 
            ) {
                $sameCharacteristics->push($userCharacteristic);
            }
        });
        $minCharacteristicValue = min($userCharacteristics->count(), $employmentCharacteristics->count());
        $characteristicCriteria = 100 * (1 - ($minCharacteristicValue - $sameCharacteristics->count()) / (max(1, $minCharacteristicValue)));

        $characteristicCriteria *= min(1, max(0.5, $this->user->testSessions->count() / 5));

        if ($userCharacteristics->count() == 0) {
            $characteristicCriteria *= 0;
        }
        
        /**
         * Desired salary logic.
         */
        $averageEmploymentSalary = ($employment->salary_from + $employment->salary_to) / 2;
        if ($this->user->desired_salary) {
            $desiredSalaryCriteria = 100 * min(1, $averageEmploymentSalary / $this->user->desired_salary);
        } else {
            $desiredSalaryCriteria = 0;
        }

        return new UserEmploymentRecommendationMetric(round($desiredSalaryCriteria, 2), round($characteristicCriteria, 2));
    }
}

