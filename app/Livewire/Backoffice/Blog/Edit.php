<?php

namespace App\Livewire\Backoffice\Blog;

use App\Models\Post;
use App\Enums\PostStatus;
use App\Enums\PostCategory;
use App\Services\LoggingService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[Layout('layouts.backoffice')]
class Edit extends Component
{
    public Post $post;
    
    // Form fields
    public $title = '';
    public $content = '';
    public $excerpt = '';
    public $metaTitle = '';
    public $metaDescription = '';
    public $featuredImage = '';
    public $status = 'draft';
    public $publishedAt = '';
    public $category = '';
    public $isFeatured = false;

    protected $listeners = [
        'refreshForm' => '$refresh',
    ];
    
    public function mount(Post $post)
    {
        $this->authorize('blog_update');
        $this->post = $post;
        $this->loadPostData();
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'metaTitle' => ['nullable', 'string', 'max:255'],
            'metaDescription' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:draft,published,archived'],
            'category' => ['nullable', 'in:' . implode(',', PostCategory::values())],
            'isFeatured' => ['boolean'],
        ];
    }

    public function loadPostData()
    {
        $this->title = $this->post->title;
        $this->content = $this->post->content;
        $this->excerpt = $this->post->excerpt;
        $this->metaTitle = $this->post->meta_title;
        $this->metaDescription = $this->post->meta_description;
        $this->featuredImage = $this->post->featured_image;
        $this->status = $this->post->status->value;
        $this->publishedAt = $this->post->published_at ? $this->post->published_at->format('Y-m-d\TH:i') : '';
        $this->category = $this->post->category?->value;
        $this->isFeatured = $this->post->is_featured;
    }

    public function update()
    {
        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
            'featured_image' => $this->featuredImage,
            'status' => PostStatus::from($this->status),
            'published_at' => $this->status === 'published' ? ($this->publishedAt ?: $this->post->published_at) : null,
            'category' => $this->category ?: null,
            'is_featured' => $this->isFeatured,
        ]);

        // Log blog post update
        LoggingService::updated('Blog Post', [
            'post_id' => $this->post->id,
            'title' => $this->title,
            'status' => $this->status,
            'is_featured' => $this->isFeatured,
            'author_id' => Auth::id(),
            'category' => $this->category,
        ]);

        session()->flash('message', __('blog.messages.updated_successfully'));
        
        return redirect()->route('backoffice.blog.index');
    }

    public function render()
    {
        return view('livewire.backoffice.blog.edit', [
            'categories' => PostCategory::options(),
            'statuses' => [
                'draft' => __('enums.post_status.draft'),
                'published' => __('enums.post_status.published'),
                'archived' => __('enums.post_status.archived'),
            ],
        ]);
    }
}
