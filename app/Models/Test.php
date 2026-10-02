<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Test extends Model
{
    protected $fillable = [
        'code',
        'name',
        'results_count',
    ];

    public function questions(): HasManyThrough
    {
        return $this->hasManyThrough(TestQuestion::class, TestQuestionGroup::class);
    }

    public function questionGroups(): HasMany
    {
        return $this->hasMany(TestQuestionGroup::class);
    }

    public function bases(): HasMany
    {
        return $this->hasMany(TestBase::class);
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}
