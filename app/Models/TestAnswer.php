<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestAnswer extends Model
{
    protected $fillable = [
        'text',
        'test_question_id',
        'test_base_id',
        'hash',
    ];

    public function bases(): BelongsToMany
    {
        return $this->belongsToMany(TestBase::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(TestQuestion::class, 'test_question_id', 'id');
    }
}
