<?php

namespace App\Models;

use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

    protected $fillable = [
        'team_id',
        'type',
        'name',
        'balance',
        'is_closed',
        'reconciled_at',
    ];

    protected $casts = [
        'type' => AccountType::class,
        'balance' => 'decimal:2',
        'is_closed' => 'boolean',
        'reconciled_at' => 'datetime',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeOpen($query)
    {
        return $query->where('is_closed', false);
    }

    public function scopeClosed($query)
    {
        return $query->where('is_closed', true);
    }

    /**
     * Scope for credit accounts (credit cards, line of credit)
     */
    public function scopeCredit($query)
    {
        $creditTypes = AccountType::getGroup('credit');
        return $query->whereIn('type', array_map(fn($type) => $type->value, $creditTypes));
    }

    /**
     * Scope for cash accounts (checking, savings, cash)
     */
    public function scopeCash($query)
    {
        $cashTypes = AccountType::getGroup('cash');
        return $query->whereIn('type', array_map(fn($type) => $type->value, $cashTypes));
    }

    /**
     * Check if this account is a credit account
     */
    public function isCreditAccount(): bool
    {
        return $this->type->belongsToGroup('credit');
    }

    /**
     * Check if this account is a cash account
     */
    public function isCashAccount(): bool
    {
        return $this->type->belongsToGroup('cash');
    }
}
