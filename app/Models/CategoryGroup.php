<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryGroup extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryGroupFactory> */
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(TransactionCategory::class, 'group_id');
    }

    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }

    public function scopeHidden($query)
    {
        return $query->where('is_hidden', true);
    }
}
