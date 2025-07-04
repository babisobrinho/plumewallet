<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_type_id', // <-- Novo campo de relacionamento
        'name',
        'balance',
        'color',
        'is_active',
        'is_balance_effective'
    ];
    public static function getDefaultColors(): array
    {
        return [
            'bg-teal-500',
            'bg-violet-500',
            'bg-lime-500',
            'bg-orange-500',
            'bg-red-500',
            'bg-cyan-500',
            'bg-purple-500'
        ];
    }
    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean',
        'is_balance_effective' => 'boolean'
    ];

    /**
     * Relação com o utilizador
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relação com o tipo de conta
     */
    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }

    /**
     * Obter ícone da conta (agora vem do accountType)
     */
    public function getIconAttribute(): string
    {
        return $this->accountType->icon ?? 'wallet';
    }

    /**
     * Formatar saldo para exibição
     */
    public function getFormattedBalanceAttribute(): string
    {
        return number_format($this->balance, 2, ',', '.') . '€';
    }

    /**
     * Scope para carteiras ativas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para carteiras com saldo efetivo
     */
    public function scopeEffectiveBalance($query)
    {
        return $query->where('is_balance_effective', true);
    }
    protected $appends = ['formatted_balance', 'icon'];
}
