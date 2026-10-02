<?php

namespace App\Http\Controllers\Api;

use App\Actions\RecordEmploymentViewAction;
use App\Contracts\Services\RecommendationServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employments\IndexEmploymentsRequest;
use App\Http\Resources\EmploymentListResource;
use App\Http\Resources\EmploymentResource;
use App\Models\Employment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmploymentController extends Controller
{
    public function __construct(
        protected int $defaultLimit = 50,
        protected bool $defaultMetrics = false,
        protected bool $defaultInteractions = false,
    ) {}

    public function index(IndexEmploymentsRequest $request)
    {
        $user = $request->user();

        $with = [];

        if ($request->boolean('interactions', $this->defaultInteractions)) {
            $with['interactions'] = function ($query) use ($user) {
                $query->where('user_id', $user->id);
            };
        }

        $data = Employment::with($with)
            ->paginate($request->limit ?? $this->defaultLimit);

        if ($request->boolean('metrics', $this->defaultMetrics)) {
            $recommendationService = app(RecommendationServiceContract::class, ['user' => $user]);
            $items = $recommendationService
                ->appendEmploymentMetrics($data->getCollection())
                ->sortByDesc(fn ($e) => $e->user_recommendation_metrics->total);
            $data->setCollection($items);
        }

        return EmploymentListResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Employment $employment)
    {
        $employment->load([
            'educationLevels',
            'educationSpheres',
            'vacancies' => fn ($q) => $q->limit(3),
        ]);

        RecordEmploymentViewAction::run($request, $employment);

        if ($request->boolean('metrics', $this->defaultMetrics)) {
            $recommendationService = app(RecommendationServiceContract::class, ['user' => $request->user()]);

            $employment = $recommendationService->appendEmploymentMetrics($employment);
        }

        return new EmploymentResource($employment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employment $employment)
    {
        DB::transaction(function () use ($employment) {
            $employment->activityTypes()->detach();
            $employment->vacancies()->detach();
            $employment->educationLevels()->detach();
            $employment->educationSpheres()->detach();
            $employment->visits()->delete();
            $employment->delete();
        });

    }
}
