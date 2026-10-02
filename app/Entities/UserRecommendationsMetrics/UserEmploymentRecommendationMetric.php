<?php

namespace App\Entities\UserRecommendationsMetrics;

class UserEmploymentRecommendationMetric extends UserRecommendationMetric
{
    public function __construct(
        public float $desired_salary_metric,
        public float $characteristics_match_metric,
    ) 
    {
        parent::__construct(config('recommendations.employments.metrics_count'));
        
        $this->checkMetricsSum();
    }
}
