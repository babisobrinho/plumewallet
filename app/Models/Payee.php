<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\PayeeStatus;

class Payee extends Model
{
    /** @use HasFactory<\Database\Factories\PayeeFactory> */
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'is_listed',
        'category_id',
    ];

    protected $casts = [
        'is_listed' => 'boolean',
    ];

    protected $appends = ['status'];

    /**
     * Get the status enum based on is_listed
     */
    public function getStatusAttribute(): PayeeStatus
    {
        return $this->is_listed ? PayeeStatus::LISTED : PayeeStatus::UNLISTED;
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class, 'category_id');
    }

    public function scopeListed($query)
    {
        return $query->where('is_listed', true);
    }

    public function scopeUnlisted($query)
    {
        return $query->where('is_listed', false);
    }
}
