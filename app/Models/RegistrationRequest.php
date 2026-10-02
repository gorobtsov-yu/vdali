<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'login',
        'email',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    public function fullName(): string
    {
        return implode(' ', array_filter([$this->last_name, $this->first_name, $this->middle_name]));
    }

    public function isProcessed(): bool
    {
        return $this->processed_at !== null;
    }

    public function markProcessed(): void
    {
        $this->forceFill(['processed_at' => now()])->save();
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->whereNull('processed_at');
    }

    public function scopeProcessed(Builder $query): Builder
    {
        return $query->whereNotNull('processed_at');
    }
}
