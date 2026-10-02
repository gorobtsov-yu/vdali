<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmploymentListResource;
use App\Models\Employment;
use App\Services\Core\RecommendationService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function employments(Request $request)
    {
        $user = $request->user();
        $limit = $request->get('limit', 15);

        $employments = Employment::join(
            'user_employment_interactions',
            'employments.id',
            '=',
            'user_employment_interactions.employment_id'
        )
            ->where('user_employment_interactions.user_id', $user->id)
            ->whereNotNull('user_employment_interactions.viewed_at')
            ->select(
                'employments.*',
                'user_employment_interactions.viewed_at as viewed_at',
                'user_employment_interactions.is_favorite as is_favorite'
            )
            ->orderBy('viewed_at', 'desc')
            ->paginate($limit);

        $recommendationService = new RecommendationService($user);
        $items = $recommendationService->appendEmploymentMetrics(
            $employments->getCollection(), false
        );
        $employments->setCollection($items);

        return EmploymentListResource::collection($employments);
    }
}
