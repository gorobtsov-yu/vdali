<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Resources\RegistrationRequestResource;
use App\Models\RegistrationRequest;
use Illuminate\Http\JsonResponse;

class RegistrationRequestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistrationRequest $request): JsonResponse
    {
        $registrationRequest = RegistrationRequest::create($request->validated());

        return RegistrationRequestResource::make($registrationRequest)
            ->response()
            ->setStatusCode(201);
    }
}
