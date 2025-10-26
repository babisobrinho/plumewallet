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
        'tags',
        'is_featured',
        'view_count',
    ];

    protected $casts = [
        'status' => PostStatus::class,
        'category' => PostCategory::class,
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'view_count' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Category and tags are now stored as enum values and arrays
    // No need for relationships

    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

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

    public function scopeByTag($query, $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }

    public function scopeByTags($query, array $tags)
    {
        return $query->where(function($q) use ($tags) {
            foreach ($tags as $tag) {
                $q->orWhereJsonContains('tags', $tag);
            }
        });
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function isPublished(): bool
    {
        return $this->status === PostStatus::PUBLISHED && 
               $this->published_at && 
               $this->published_at <= now();
    }

    /**
     * Get the category enum instance
     */
    public function getCategoryEnum(): ?PostCategory
    {
        return $this->category;
    }

    /**
     * Get the tags as enum instances
     */
    public function getTagEnums(): array
    {
        if (!$this->tags) {
            return [];
        }

        return array_map(function($tag) {
            return PostTag::from($tag);
        }, $this->tags);
    }

    /**
     * Check if post has a specific tag
     */
    public function hasTag(PostTag $tag): bool
    {
        return in_array($tag->value, $this->tags ?? []);
    }

    /**
     * Add a tag to the post
     */
    public function addTag(PostTag $tag): void
    {
        $tags = $this->tags ?? [];
        if (!in_array($tag->value, $tags)) {
            $tags[] = $tag->value;
            $this->tags = $tags;
        }
    }

    /**
     * Remove a tag from the post
     */
    public function removeTag(PostTag $tag): void
    {
        $tags = $this->tags ?? [];
        $this->tags = array_values(array_filter($tags, fn($t) => $t !== $tag->value));
    }
}
