<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmploymentListResource extends JsonResource
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
            'metrics' => $this->when(
                isset($this->user_recommendation_metrics),
                fn () => [
                    'desired_salary_metric' => $this->user_recommendation_metrics->desired_salary_metric,
                    'characteristics_match_metric' => $this->user_recommendation_metrics->characteristics_match_metric,
                    'count' => $this->user_recommendation_metrics->count,
                    'total' => $this->user_recommendation_metrics->total,
                ]
            ),
            'is_favorite' => $this->whenLoaded(
                'interactions',
                $interaction?->is_favorite ?? false
            ),
            'viewed_at' => $this->when(
                'interactions',
                $interaction?->viewed_at ?? null
            ),
        ];
    }
}
