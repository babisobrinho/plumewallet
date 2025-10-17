<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionCategory extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'group_id',
        'name',
        'assigned_amount',
    ];

    protected $casts = [
        'assigned_amount' => 'decimal:2',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(CategoryGroup::class, 'group_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'category_id');
    }

    public function payees(): HasMany
    {
        return $this->hasMany(Payee::class, 'category_id');
    }
}
