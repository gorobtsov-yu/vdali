<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmploymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $interaction = $this->interactions->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'education_levels' => EducationLevelResource::collection($this->whenLoaded('educationLevels')),
            'education_spheres' => EducationSphereResource::collection($this->whenLoaded('educationSpheres')),
            'characteristics' => CharacteristicResource::collection($this->characteristics()),
            'vacancies' => VacancyResource::collection($this->whenLoaded('vacancies')),
            'metrics' => $this->when(
                isset($this->user_recommendation_metrics),
                fn () => [
                    'desired_salary_metric' => $this->user_recommendation_metrics->desired_salary_metric,
                    'characteristics_match_metric' => $this->user_recommendation_metrics->characteristics_match_metric,
                    'count' => $this->user_recommendation_metrics->count,
                    'total' => $this->user_recommendation_metrics->total,
                ]
            ),
            'is_favorite' => $this->when(
                $request->boolean('interactions'),
                $interaction?->is_favorite ?? false
            ),
            'viewed_at' => $this->when(
                $request->boolean('interactions'),
                $interaction?->viewed_at ?? null
            ),
        ];
    }
}
