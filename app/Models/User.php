<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'whatsapp_number', // Adicionei campo para integração com WhatsApp
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
        ];
    }

    /**
     * Relationship with categories
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Relationship with transactions (movimentos financeiros)
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relationship with accounts (contas bancárias/carteiras)
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Relationship with budgets (orçamentos)
     */
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    /**
     * Get the user's preferred color scheme from profile
     */
    public function getThemeAttribute()
    {
        return $this->profile_photo_path ? 'dark' : 'light';
    }

    /**
     * Check if user has connected WhatsApp
     */
    public function hasWhatsAppConnected(): bool
    {
        return !empty($this->whatsapp_number);
    }

    /**
     * Scope for users with WhatsApp connected
     */
    public function scopeWithWhatsApp($query)
    {
        return $query->whereNotNull('whatsapp_number');
    }
}