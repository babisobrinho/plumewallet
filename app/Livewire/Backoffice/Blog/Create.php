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
class Create extends Component
{
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
    
    public function mount()
    {
        $this->authorize('blog_create');
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

    public function save()
    {
        $this->validate();

        $post = Post::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
            'featured_image' => $this->featuredImage,
            'status' => PostStatus::from($this->status),
            'published_at' => $this->status === 'published' ? ($this->publishedAt ?: now()) : null,
            'author_id' => Auth::id(),
            'category' => $this->category ?: null,
            'is_featured' => $this->isFeatured,
        ]);

        // Log blog post creation
        LoggingService::created('Blog Post', [
            'post_id' => $post->id,
            'title' => $this->title,
            'status' => $this->status,
            'is_featured' => $this->isFeatured,
            'author_id' => Auth::id(),
            'category' => $this->category,
        ]);

        session()->flash('message', __('blog.messages.created_successfully'));
        
        return redirect()->route('backoffice.blog.index');
    }

    public function render()
    {
        return view('livewire.backoffice.blog.create', [
            'categories' => PostCategory::options(),
            'statuses' => [
                'draft' => __('enums.post_status.draft'),
                'published' => __('enums.post_status.published'),
                'archived' => __('enums.post_status.archived'),
            ],
        ]);
    }
}
