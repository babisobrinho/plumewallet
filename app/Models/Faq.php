<?php

namespace App\Models;

use App\Enums\FaqCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'order',
        'is_active',
        'view_count',
    ];

    protected $casts = [
        'category' => FaqCategory::class,
        'is_active' => 'boolean',
        'order' => 'integer',
        'view_count' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, FaqCategory $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}
