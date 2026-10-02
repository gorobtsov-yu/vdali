<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tests\IndexTestsRequest;
use App\Http\Requests\Tests\StoreTestsRequest;
use App\Http\Requests\Tests\UpdateTestsRequest;
use App\Http\Resources\TestDetailResource;
use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function __construct(protected int $defaultLimit = 50) {}

    public function index(IndexTestsRequest $request)
    {
        $data = Test::with('questions.answers')
            ->paginate($request->limit ?? $this->defaultLimit);

        return TestResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestsRequest $request)
    {
        $test = DB::transaction(function () use ($request) {
            $test = Test::create($request->only('name', 'code', 'description', 'results_count'));

            foreach ($request->groups as $groupData) {
                $group = $test->questionGroups()->create();

                foreach ($groupData['questions'] as $questionData) {
                    $question = $group->questions()->create([
                        'text' => $questionData['text'],
                        'code' => $questionData['code'],
                        'queue_position' => $questionData['queue_position'],
                    ]);

                    foreach ($questionData['answers'] as $answerData) {
                        $question->answers()->create([
                            'text' => $answerData['text'],
                            'hash' => $answerData['hash'],
                        ]);
                    }
                }
            }

            return $test->load('questions.answers');
        });

        return new TestResource($test);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        $test->load('questions.answers');

        return new TestDetailResource($test);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestsRequest $request, Test $test)
    {
        DB::transaction(function () use ($request, $test) {
            $test->update($request->only('name', 'code', 'description', 'results_count'));

            if ($request->has('groups')) {
                foreach ($test->questionGroups as $group) {
                    foreach ($group->questions as $question) {
                        $question->answers()->delete();
                    }
                    $group->questions()->delete();
                }
                $test->questionGroups()->delete();
                foreach ($request->groups as $groupData) {
                    $group = $test->questionGroups()->create();

                    foreach ($groupData['questions'] as $questionData) {
                        $question = $group->questions()->create([
                            'text' => $questionData['text'],
                            'code' => $questionData['code'],
                            'queue_position' => $questionData['queue_position'],
                        ]);

                        foreach ($questionData['answers'] as $answerData) {
                            $question->answers()->create([
                                'text' => $answerData['text'],
                                'hash' => $answerData['hash'],
                            ]);
                        }
                    }
                }
            }
        });

        return new TestResource($test->load('questions.answers'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        DB::transaction(function () use ($test) {
            $test->load('questionGroups.questions.answers');

            foreach ($test->questionGroups as $group) {
                foreach ($group->questions as $question) {
                    $question->answers()->delete();
                }
                $group->questions()->delete();
            }
            $test->questionGroups()->delete();
            $test->delete();
        });

    }
}
