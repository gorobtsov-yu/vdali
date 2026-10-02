<?php

namespace App\Entities\UserRecommendationsMetrics;

use App\Exceptions\Recomendations\InvalidMetricException;
use ReflectionClass;

abstract class UserRecommendationMetric
{
    public float $total;

    public int $count;

    private int $limit;

    public function __construct(int $metricsCount, ?int $metricsValueLimit = null)
    {
        $this->limit = (int)($metricsCount * ($metricsValueLimit ?? config('recommendations.default.metrics_value_limit', 100)));

        $this->count = $metricsCount;

        $this->total = 0;
    }

    protected function checkMetricsSum(): void 
    {
        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties();

        foreach ($properties as $property) {
            if ($this->isMetricProperty($property->getName())) {

                $value = $property->getValue($this);

                if (is_numeric($value) && $value >= 0) {
                    $this->total += $value / $this->count;
                } else {
                    throw new InvalidMetricException('The property value must be positive number.');
                }
            }
        }

        if ($this->total > $this->limit) {
            throw new InvalidMetricException(limit: $this->limit);
        }

        $this->total = round($this->total, 2);
    }

    private function isMetricProperty(string $propertyName): bool 
    {
        $pattern = '/_[Mm]etric$/';

        if (preg_match($pattern, $propertyName)) {
            return true;
        }

        return false;
    }
}
