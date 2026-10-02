<?php

namespace App\Contracts\Services;

use App\Models\Employment;
use Illuminate\Support\Collection;

interface RecommendationServiceContract
{
    public function appendEmploymentMetrics(Employment|Collection $employments): Employment|Collection;
}
