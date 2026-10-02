<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStatus extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    
    protected $compositeKey = ['user_id', 'activity_type_id'];

    protected $fillable = [
        'user_id',
        'activity_type_id',
        'count',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activityType(): BelongsTo
    {
        return $this->belongsTo(ActivityType::class);
    }
}
