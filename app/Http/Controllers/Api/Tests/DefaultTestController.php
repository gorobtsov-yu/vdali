<?php

namespace App\Http\Controllers\Api\Tests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tests\Default\StoreDefaultTestRequest;
use App\Http\Resources\TestBaseResource;
use App\Models\Test;
use App\Models\TestBase;
use App\Services\TestService;
use App\Services\UserStatusService;

class DefaultTestController extends Controller
{
    public function store(StoreDefaultTestRequest $request, Test $test)
    {
        $testService = new TestService($test);
        $userStatusService = new UserStatusService($request->user());

        $baseResults = $testService->getBaseResults($request->all());
        $testResult = TestBase::where('code', $baseResults->keys()->first())->first();

        $userStatusService->setTestResultsWithBases($test, $baseResults);

        return new TestBaseResource($testResult);
    }
}
