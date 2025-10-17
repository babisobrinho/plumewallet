<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'account_id',
        'transactionable_id',
        'transactionable_type',
        'date',
        'category_id',
        'description',
        'amount',
        'is_cleared',
        'is_reconciled',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
        'is_cleared' => 'boolean',
        'is_reconciled' => 'boolean',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Polymorphic relationship
     */
    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class, 'category_id');
    }

    public function scopeCleared($query)
    {
        return $query->where('is_cleared', true);
    }

    public function scopeReconciled($query)
    {
        return $query->where('is_reconciled', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_cleared', false);
    }
}
