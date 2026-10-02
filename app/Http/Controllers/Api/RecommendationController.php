<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recommendations\EmploymentsRecommendationRequest;
use App\Http\Resources\EmploymentListResource;
use App\Models\Employment;
use App\Services\Core\RecommendationService;

class RecommendationController extends Controller
{
    public function __construct() {}

    public function employments(EmploymentsRecommendationRequest $request)
    {
        $user = $request->user();
        $limit = (int) $request->get('limit', 3);
        $recommendationService = new RecommendationService($user);

        $favorites = $user->favoriteEmployments()
            ->with('interactions')
            ->get();

        $filteredFavorites = $recommendationService
            ->appendEmploymentMetrics($favorites)
            ->filter(fn ($e) => $e->user_recommendation_metrics->total > 0);

        $selected = collect();
        if ($filteredFavorites->isNotEmpty()) {
            $selected = $filteredFavorites->shuffle()->take(min(2, $filteredFavorites->count()));
        }

        $needed = $limit - $selected->count();

        if ($needed > 0) {
            $selectedIds = $selected->pluck('id')->toArray();

            $otherEmployments = Employment::whereNotIn('id', function ($query) use ($user) {
                $query->select('employment_id')
                    ->from('user_employment_interactions')
                    ->where('user_id', $user->id)
                    ->where('is_favorite', true);
            })
                ->with('interactions')
                ->get();

            $filteredOthers = $recommendationService
                ->appendEmploymentMetrics($otherEmployments)
                ->filter(fn ($e) => $e->user_recommendation_metrics->total > 0);

            $topOthers = $filteredOthers->sortByDesc(fn ($e) => $e->user_recommendation_metrics->total)
                ->take($needed);

            $selected = $selected->merge($topOthers);
        }

        return EmploymentListResource::collection($selected->sortByDesc(fn ($e) => $e->user_recommendation_metrics->total));
    }
}
