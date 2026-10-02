<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'salary',
        'description',
        'contact',
    ];

    protected $table = 'vacancies';

    public function employments(): BelongsToMany
    {
        return $this->belongsToMany(Employment::class);
    }
}
