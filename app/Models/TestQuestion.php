<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestQuestion extends Model
{
    protected $fillable = [
        'code',
        'text',
        'queue_position',
        'test_question_group_id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(TestQuestionGroup::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(TestAnswer::class);
    }
}
