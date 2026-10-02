<?php

namespace App\Http\Resources;

use App\ValueObject\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
   public function toArray(Request $request): array
    {
    return [
        'id'                => $this->id,
        'first_name'        => $this->first_name,
        'last_name'         => $this->last_name,
        'middle_name'       => $this->middle_name,
        'full_name'         => $this->full_name,
        'login'             => $this->login,
        'email'             => $this->email,
        'panel_access'      => $this->hasPermissionTo(Permission::FILAMENT->value) || $this->hasPermissionTo(Permission::ALL->value),
        'desired_salary'    => $this->desired_salary,
        'education_levels'  => EducationLevelResource::collection($this->whenLoaded('educationLevels')),
        'education_spheres' => EducationSphereResource::collection($this->whenLoaded('educationSpheres')),
        'activity_types'    => ActivityTypeResource::collection($this->whenLoaded('activityTypes')),
        'characteristics'   => CharacteristicResource::collection($this->characteristics()),
    ];
    }
}
