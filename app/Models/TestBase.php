<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TestBase extends Model
{
    protected $fillable = [
        'code',
        'name',
        'test_id',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(TestQuestion::class);
    }

    public function activityTypes(): BelongsToMany
    {
        return $this->belongsToMany(ActivityType::class);
    }
}
