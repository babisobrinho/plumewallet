<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Enums\PostCategory;
use App\Enums\PostTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'featured_image',
        'status',
        'published_at',
        'author_id',
        'category',
        'is_featured',
    ];

    protected $casts = [
        'status' => PostStatus::class,
        'category' => PostCategory::class,
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Category and tags are now stored as enum values and arrays
    // No need for relationships

    // Post comments feature removed from project; relation intentionally removed.

    public function scopePublished($query)
    {
        return $query->where('status', PostStatus::PUBLISHED)
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', PostStatus::DRAFT);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}


