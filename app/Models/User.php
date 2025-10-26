<?php

namespace App\Models;

use App\Enums\AppTheme;
use App\Enums\RoleType;
use App\Traits\HasRoleTypes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasProfilePhoto, HasTeams, HasRoles, HasRoleTypes;
    use Notifiable, TwoFactorAuthenticatable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'language',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'theme',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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
            'theme' => AppTheme::class,
        ];
    }

    /**
     * Check if user is staff
     */
    public function isStaff(): bool
    {
        return $this->hasRoleType(RoleType::STAFF->value);
    }

    /**
     * Check if user is client
     */
    public function isClient(): bool
    {
        return $this->hasRoleType(RoleType::CLIENT->value);
    }

    /**
     * Get the user's role type
     */
    public function getTypeAttribute(): ?string
    {
        $role = $this->roles->first();
        return $role ? $role->type : null;
    }
}
