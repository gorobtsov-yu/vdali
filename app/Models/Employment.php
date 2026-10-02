<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Employment extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'salary_from',
        'salary_to',
    ];

    public function activityTypes(): BelongsToMany
    {   
        return $this->belongsToMany(ActivityType::class);
    }

    public function characteristics(int $limit = 5)
    {
        return Characteristic::query()
            ->select('characteristics.code', 'characteristics.name')
            ->selectRaw('COUNT(characteristics.code) as count')
            ->join('activity_type_characteristic', 
                'characteristics.id', '=', 'activity_type_characteristic.characteristic_id')
            ->join('activity_type_employment',
                'activity_type_characteristic.activity_type_id', '=', 
                'activity_type_employment.activity_type_id')
            ->where('activity_type_employment.employment_id', $this->id)
            ->groupBy('characteristics.code', 'characteristics.name')
            ->orderBy('count', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function vacancies(): BelongsToMany
    {
        return $this->belongsToMany(Vacancy::class);
    }

    public function educationLevels(): BelongsToMany
    {
        return $this->belongsToMany(EducationLevel::class);
    }

    public function educationSpheres(): BelongsToMany
    {
        return $this->belongsToMany(EducationSphere::class);
    }

    public function interactions()
    {
        return $this->hasMany(UserEmploymentInteraction::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'user_employment_interactions')
                    ->wherePivot('is_favorite', true)
                    ->withPivot('created_at')
                    ->withTimestamps();
    }
}
