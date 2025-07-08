<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type',
        'account_id',
        'amount',
        'description',
        'transaction_date',
        'status',
        'category_id',
        'obs',
        'user_id'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2'
    ];

    /**
     * Relacionamento com User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com Account
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Relacionamento com Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope para filtrar por tipo de transação
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('transaction_type', $type);
    }

    /**
     * Scope para filtrar por utilizador
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope para filtrar por status
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope para rendimentos
     */
    public function scopeIncomes($query)
    {
        return $query->where('transaction_type', 'income');
    }

    /**
     * Scope para despesas
     */
    public function scopeExpenses($query)
    {
        return $query->where('transaction_type', 'expense');
    }

    /**
     * Scope para transferências
     */
    public function scopeTransfers($query)
    {
        return $query->where('transaction_type', 'transfer');
    }

    /**
     * Accessor para formatar o valor
     */
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }

    /**
     * Accessor para cor baseada no tipo
     */
    public function getTypeColorAttribute()
    {
        return match($this->transaction_type) {
            'income' => 'text-green-600',
            'expense' => 'text-red-600',
            'transfer' => 'text-blue-600',
            default => 'text-gray-600'
        };
    }

    /**
     * Accessor para ícone baseado no tipo
     */
    public function getTypeIconAttribute()
    {
        return match($this->transaction_type) {
            'income' => '↗️',
            'expense' => '↘️',
            'transfer' => '↔️',
            default => '💰'
        };
    }
}

