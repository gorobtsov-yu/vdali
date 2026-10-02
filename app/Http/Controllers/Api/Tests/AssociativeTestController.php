<?php

namespace App\Http\Controllers\Api\Tests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tests\Associative\ShowAssociativeTestRequest;
use App\Http\Requests\Tests\Associative\StoreAssociativeTestRequest;
use App\Http\Resources\EmploymentResource;
use App\Http\Resources\Tests\AssociativeTestResultResource;
use App\Models\ActivityType;
use App\Services\GigaChatService;
use App\Services\TestService;
use App\Services\UserStatusService;

class AssociativeTestController extends Controller
{
    public function store(StoreAssociativeTestRequest $request)
    {
        $user = $request->user();

        $userStatusService = new UserStatusService($user);

        $activityTypeResults = TestService::getAssociativeTestResults($request->all());
        $testResult = ActivityType::where('code', $activityTypeResults->keys()->first())->first();
        $userStatusService->setTestResultsWithActivityTypes($activityTypeResults);

        $result = GigaChatService::getAssociativeTestExplanation($request->user(), $testResult);

        return new AssociativeTestResultResource($result);
    }

    public function show(ShowAssociativeTestRequest $request)
    {
        return EmploymentResource::collection(TestService::getAssociativeTestPull($request->user(), $request->get('limit')));
    }
}
