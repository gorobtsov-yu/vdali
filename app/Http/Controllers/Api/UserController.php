<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUsersRequest;
use App\Http\Requests\Users\IndexUsersRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected int $defaultLimit = 50)
    {
    }

    public function index(IndexUsersRequest $request)
    {
        $data = User::with(['educationLevels', 'educationSpheres', 'activityTypes'])
        ->paginate($request->limit ?? $this->defaultLimit);

        return UserResource::collection($data);
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
    public function show(User $user)
    {
        $user->load(['educationLevels', 'educationSpheres', 'activityTypes']);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->load(['educationLevels', 'educationSpheres', 'activityTypes']);
        
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // me

    public function me(Request $request) 
    {
        return $this->show($request->user());
    }

    public function updateMe(UpdateUsersRequest $request) 
    {
        return $this->update($request, $request->user());
    }
}
