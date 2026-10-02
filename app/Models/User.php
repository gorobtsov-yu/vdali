<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\ValueObject\Permission;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'login',
        'desired_salary',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function status(): HasMany
    {
        return $this->hasMany(UserStatus::class);
    }

    protected function testSessions(): HasMany
    {
        return $this->hasMany(TestSession::class);
    }

    public function characteristics(int $limit = 5)
    {
        return Characteristic::query()
            ->select('characteristics.code', 'characteristics.name')
            ->selectRaw('COUNT(characteristics.code) * user_statuses.count as count')
            ->join('activity_type_characteristic', 'activity_type_characteristic.characteristic_id', '=', 'characteristics.id')
            ->join('user_statuses', 'user_statuses.activity_type_id', '=', 'activity_type_characteristic.activity_type_id')
            ->where('user_statuses.user_id', $this->id)
            ->groupBy('characteristics.code', 'characteristics.name', 'user_statuses.count')
            ->orderBy('count', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function activityTypes(): HasManyThrough
    {
        return $this->hasManyThrough(
            ActivityType::class,
            UserStatus::class,
            'user_id',
            'id',
            'id',
            'activity_type_id'
        );
    }

    public function getFilamentName(): string
    {
        return $this->login;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasPermissionTo(Permission::ALL->value) || $this->hasPermissionTo(Permission::FILAMENT->value);
    }

    protected function fullName(): Attribute
    {
        return new Attribute(function (mixed $value, array $attributes) {
            $fullName = $attributes['last_name'].' '.$attributes['first_name'];

            if ($attributes['middle_name']) {
                $fullName .= ' '.$attributes['middle_name'];
            }

            return $fullName;
        });
    }

    public function educationLevels(): BelongsToMany
    {
        return $this->belongsToMany(EducationLevel::class);
    }

    public function educationSpheres(): BelongsToMany
    {
        return $this->belongsToMany(EducationSphere::class);
    }

    public function employmentInteractions()
    {
        return $this->hasMany(UserEmploymentInteraction::class);
    }

    public function favoriteEmployments()
    {
        return $this->belongsToMany(Employment::class, 'user_employment_interactions')
            ->wherePivot('is_favorite', true)
            ->withPivot('created_at')
            ->withTimestamps();
    }

    public function hasFavorite(string $code): bool
    {
        return $this->favoriteEmployments()->where('code', $code)->exists();
    }

    public function getViewedEmploymentIdsAttribute(): array
    {
        return $this->employmentInteractions()
            ->whereNotNull('viewed_at')
            ->pluck('employment_id')
            ->toArray();
    }
}
