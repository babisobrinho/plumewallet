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
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'timezone',
        'locale',
        'last_login_at',
        'last_login_ip',
        'login_count',
        'is_active',
        'deactivated_at',
        'deactivation_reason',
        'onboarding_completed',
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
            'last_login_at' => 'datetime',
            'deactivated_at' => 'datetime',
            'is_active' => 'boolean',
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
     * Relação com as carteiras do utilizador
     */

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Obter carteiras ativas do utilizador
     */
    public function activeAccounts(): HasMany
    {
        return $this->hasMany(Account::class)->where('is_active', true);
    }


    /**
     * Calcular saldo total de todas as carteiras
     */
    public function getTotalBalanceAttribute(): float
    {
        return $this->accounts()
            ->where('is_active', true)
            ->where('is_balance_effective', true)
            ->sum('balance');
    }

    /**
     * Obter saldo total formatado
     */
    public function getFormattedTotalBalanceAttribute(): string
    {
        return number_format($this->total_balance, 2, ',', '.') . '€';
    }

    /**
     * Relações do Backoffice
     */
    
    // Login attempts
    public function loginAttempts()
    {
        return $this->hasMany(LoginAttempt::class);
    }

    // Blog posts authored
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    // Support tickets created
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    // Support tickets assigned
    public function assignedTickets()
    {
        return $this->hasMany(SupportTicket::class, 'assigned_agent_id');
    }

    // Ticket messages
    public function ticketMessages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    // System logs
    public function systemLogs()
    {
        return $this->hasMany(SystemLog::class);
    }

    // Audit logs
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    // Saved reports
    public function savedReports()
    {
        return $this->hasMany(SavedReport::class);
    }

    // Onboarding responses
    public function onboardingResponses()
    {
        return $this->hasMany(UserOnboardingResponse::class);
    }

    // Check if user has completed onboarding
    public function hasCompletedOnboarding()
    {
        return $this->onboarding_completed;
    }
}