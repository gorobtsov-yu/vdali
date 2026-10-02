<?php

namespace App\Http\Controllers\Api\Favorites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorites\StoreFavoriteEmploymentRequest;
use App\Http\Resources\EmploymentListResource;
use App\Models\Employment;
use App\Models\UserEmploymentInteraction;
use App\Services\Core\RecommendationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteEmploymentController extends Controller
{
    public function __construct(
        protected int $defaultLimit = 50,
    ) {}

    public function index(Request $request)
    {
        $user = $request->user();
        $limit = $request->get('limit', $this->defaultLimit);

        $favorites = $user->favoriteEmployments()
            ->with('interactions')
            ->paginate($limit);

        $recommendationService = new RecommendationService($user);
        $items = $recommendationService->appendEmploymentMetrics(
            $favorites->getCollection()
        );

        $favorites->setCollection($items);

        return EmploymentListResource::collection($favorites);
    }

    public function store(StoreFavoriteEmploymentRequest $request)
    {
        $employment = Employment::where('code', $request->code)->firstOrFail();

        UserEmploymentInteraction::updateOrCreate(
            ['user_id' => $request->user()->id, 'employment_id' => $employment->id],
            ['is_favorite' => true]
        );

    }

    public function destroy(StoreFavoriteEmploymentRequest $request)
    {
        $employment = Employment::where('code', $request->code)->firstOrFail();

        $updated = UserEmploymentInteraction::where([
            'user_id' => $request->user()->id,
            'employment_id' => $employment->id,
        ])->update(['is_favorite' => false]);

    }

    public function check(Request $request, string $code): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'is_favorite' => $request->user()->hasFavorite($code),
        ]);
    }
}
