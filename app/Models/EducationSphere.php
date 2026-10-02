<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EducationSphere extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function employments(): BelongsToMany
    {
        return $this->belongsToMany(Employment::class);
    }
}
