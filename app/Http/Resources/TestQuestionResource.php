<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'code' => $this->code,
            'queue_position' => $this->queue_position,
            'answers' => TestAnswerResource::collection($this->whenLoaded('answers')),
        ];
    }
}
