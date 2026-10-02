<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancies\IndexVacanciesRequest;
use App\Http\Requests\Vacancies\StoreVacanciesRequest;
use App\Http\Requests\Vacancies\UpdateVacanciesRequest;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;

class VacancyController extends Controller
{
    public function __construct(protected int $defaultLimit = 50) {}

    public function index(IndexVacanciesRequest $request)
    {

        $data = Vacancy::paginate($request->limit ?? $this->defaultLimit);

        return VacancyResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVacanciesRequest $request)
    {
        $vacancy = Vacancy::create($request->all());

        return new VacancyResource($vacancy);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        return new VacancyResource($vacancy);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVacanciesRequest $request, Vacancy $vacancy)
    {
        $vacancy->update($request->all());

        return new VacancyResource($vacancy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();

    }
}
