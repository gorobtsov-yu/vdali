<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmploymentInteraction extends Model
{
    protected $fillable = [
        'user_id', 'employment_id', 'is_favorite', 'viewed_at'
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'viewed_at'   => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employment()
    {
        return $this->belongsTo(Employment::class);
    }
}