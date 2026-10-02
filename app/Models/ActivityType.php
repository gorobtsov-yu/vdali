<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ActivityType extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function employments(): BelongsToMany
    {
        return $this->belongsToMany(Employment::class);
    }

    public function characteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class);
    }

    public function bases(): BelongsToMany
    {
        return $this->belongsToMany(TestBase::class);
    }
}
