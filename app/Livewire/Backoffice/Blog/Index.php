<?php

namespace App\Livewire\Backoffice\Blog;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\User;
use App\Enums\PostStatus;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithPagination;

    // Modal properties
    public $showModal = false;
    public $isEditing = false;
    public $editingPost = null;
    
    // Modal form fields
    public $modalTitle = '';
    public $modalContent = '';
    public $modalExcerpt = '';
    public $modalMetaTitle = '';
    public $modalMetaDescription = '';
    public $modalFeaturedImage = '';
    public $modalStatus = 'draft';
    public $modalPublishedAt = '';
    public $modalCategoryId = '';
    public $modalIsFeatured = false;
    public $modalTags = [];

    // Search and filters
    public $search = '';
    public $filters = [
        'status' => '',
        'category' => '',
        'author' => '',
    ];

    protected $listeners = [
        'refreshTable' => '$refresh',
        'editItem' => 'editPost',
        'deleteItem' => 'deletePost',
        'toggleFeatured' => 'toggleFeatured',
    ];
    
    public function mount()
    {
        $this->authorize('blog_read');
    }

    public function getFilterOptionsProperty()
    {
        return [
            [
                'key' => 'status',
                'label' => __('blog.filters.status'),
                'type' => 'select',
                'placeholder' => __('blog.filters.all_status'),
                'options' => [
                    'draft' => __('enums.post_status.draft'),
                    'published' => __('enums.post_status.published'),
                    'archived' => __('enums.post_status.archived'),
                ]
            ],
            [
                'key' => 'category',
                'label' => __('blog.filters.category'),
                'type' => 'select',
                'placeholder' => __('blog.filters.all_categories'),
                'options' => PostCategory::active()->get()->mapWithKeys(function($category) {
                    return [$category->id => $category->name];
                })->toArray()
            ],
            [
                'key' => 'author',
                'label' => __('blog.filters.author'),
                'type' => 'select',
                'placeholder' => __('blog.filters.all_authors'),
                'options' => User::whereHas('roles', function($query) {
                    $query->where('type', 'staff');
                })->get()->mapWithKeys(function($user) {
                    return [$user->id => $user->name];
                })->toArray()
            ]
        ];
    }

    public function getTableColumnsProperty()
    {
        return [
            [
                'key' => 'title',
                'label' => __('blog.table.title'),
                'sortable' => true,
                'class' => 'w-1/3',
            ],
            [
                'key' => 'category',
                'label' => __('blog.table.category'),
                'component' => 'livewire.backoffice.blog.partials.category-badge',
                'sortable' => false,
                'class' => 'w-1/6',
            ],
            [
                'key' => 'author.name',
                'label' => __('blog.table.author'),
                'sortable' => false,
                'class' => 'w-1/6',
            ],
            [
                'key' => 'status',
                'label' => __('blog.table.status'),
                'component' => 'livewire.backoffice.blog.partials.status-badge',
                'sortable' => true,
                'class' => 'w-1/6',
            ],
            [
                'key' => 'published_at',
                'label' => __('blog.table.published_at'),
                'sortable' => true,
                'class' => 'w-1/6',
                'format' => 'datetime',
            ],
            [
                'key' => 'view_count',
                'label' => __('blog.table.views'),
                'sortable' => true,
                'class' => 'w-1/12',
            ],
        ];
    }

    public function getTableActionsProperty()
    {
        return [
            [
                'type' => 'dropdown',
                'items' => [
                    [
                        'label' => __('common.buttons.edit'),
                        'method' => 'editPost',
                        'icon' => 'pencil',
                    ],
                    [
                        'label' => __('blog.actions.toggle_featured'),
                        'method' => 'toggleFeatured',
                        'icon' => 'star',
                    ],
                    [
                        'label' => __('common.buttons.delete'),
                        'method' => 'deletePost',
                        'icon' => 'trash',
                    ],
                ]
            ]
        ];
    }

    public function getDataProperty()
    {
        $query = Post::with(['author', 'category', 'tags'])
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->when($this->filters['status'], function($query) {
                $query->where('status', $this->filters['status']);
            })
            ->when($this->filters['category'], function($query) {
                $query->where('category_id', $this->filters['category']);
            })
            ->when($this->filters['author'], function($query) {
                $query->where('author_id', $this->filters['author']);
            });

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    // Metric properties
    public function getTotalPostsProperty()
    {
        return Post::count();
    }

    public function getPublishedPostsProperty()
    {
        return Post::published()->count();
    }

    public function getDraftPostsProperty()
    {
        return Post::draft()->count();
    }

    public function getFeaturedPostsProperty()
    {
        return Post::featured()->published()->count();
    }

    public function clearFilters()
    {
        $this->filters = [
            'status' => '',
            'category' => '',
            'author' => '',
        ];
    }

    public function sortColumn($column)
    {
        // Implement sorting logic if needed
    }

    public function createPost()
    {
        $this->authorize('blog_create');
        
        $this->isEditing = false;
        $this->editingPost = null;
        $this->resetModalForm();
        $this->showModal = true;
    }

    public function editPost($postId)
    {
        $this->authorize('blog_update');
        
        $this->isEditing = true;
        $this->editingPost = Post::findOrFail($postId);
        $this->loadPostData();
        $this->showModal = true;
    }

    public function deletePost($postId)
    {
        $this->authorize('blog_delete');
        
        $post = Post::findOrFail($postId);
        $post->delete();
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('blog.messages.deleted_successfully'));
    }

    public function toggleFeatured($postId)
    {
        $this->authorize('blog_update');
        
        $post = Post::findOrFail($postId);
        $post->update(['is_featured' => !$post->is_featured]);
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('blog.messages.featured_toggled'));
    }

    public function savePost()
    {
        $this->validate([
            'modalTitle' => ['required', 'string', 'max:255'],
            'modalContent' => ['required', 'string'],
            'modalExcerpt' => ['nullable', 'string', 'max:500'],
            'modalMetaTitle' => ['nullable', 'string', 'max:255'],
            'modalMetaDescription' => ['nullable', 'string', 'max:500'],
            'modalStatus' => ['required', 'in:draft,published,archived'],
            'modalCategoryId' => ['nullable', 'exists:post_categories,id'],
            'modalIsFeatured' => ['boolean'],
        ]);

        if ($this->isEditing) {
            $this->updatePost();
        } else {
            $this->createPostData();
        }

        $this->closeModal();
        $this->dispatch('refreshTable');
    }

    public function createPostData()
    {
        $post = Post::create([
            'title' => $this->modalTitle,
            'slug' => Str::slug($this->modalTitle),
            'content' => $this->modalContent,
            'excerpt' => $this->modalExcerpt,
            'meta_title' => $this->modalMetaTitle,
            'meta_description' => $this->modalMetaDescription,
            'featured_image' => $this->modalFeaturedImage,
            'status' => PostStatus::from($this->modalStatus),
            'published_at' => $this->modalStatus === 'published' ? ($this->modalPublishedAt ?: now()) : null,
            'author_id' => Auth::id(),
            'category_id' => $this->modalCategoryId ?: null,
            'is_featured' => $this->modalIsFeatured,
        ]);

        // Attach tags
        if (!empty($this->modalTags)) {
            $post->tags()->sync($this->modalTags);
        }

        session()->flash('message', __('blog.messages.created_successfully'));
    }

    public function updatePost()
    {
        $this->editingPost->update([
            'title' => $this->modalTitle,
            'slug' => Str::slug($this->modalTitle),
            'content' => $this->modalContent,
            'excerpt' => $this->modalExcerpt,
            'meta_title' => $this->modalMetaTitle,
            'meta_description' => $this->modalMetaDescription,
            'featured_image' => $this->modalFeaturedImage,
            'status' => PostStatus::from($this->modalStatus),
            'published_at' => $this->modalStatus === 'published' ? ($this->modalPublishedAt ?: $this->editingPost->published_at) : null,
            'category_id' => $this->modalCategoryId ?: null,
            'is_featured' => $this->modalIsFeatured,
        ]);

        // Update tags
        if (!empty($this->modalTags)) {
            $this->editingPost->tags()->sync($this->modalTags);
        }

        session()->flash('message', __('blog.messages.updated_successfully'));
    }

    public function loadPostData()
    {
        $this->modalTitle = $this->editingPost->title;
        $this->modalContent = $this->editingPost->content;
        $this->modalExcerpt = $this->editingPost->excerpt;
        $this->modalMetaTitle = $this->editingPost->meta_title;
        $this->modalMetaDescription = $this->editingPost->meta_description;
        $this->modalFeaturedImage = $this->editingPost->featured_image;
        $this->modalStatus = $this->editingPost->status->value;
        $this->modalPublishedAt = $this->editingPost->published_at ? $this->editingPost->published_at->format('Y-m-d\TH:i') : '';
        $this->modalCategoryId = $this->editingPost->category_id;
        $this->modalIsFeatured = $this->editingPost->is_featured;
        $this->modalTags = $this->editingPost->tags->pluck('id')->toArray();
    }

    public function resetModalForm()
    {
        $this->modalTitle = '';
        $this->modalContent = '';
        $this->modalExcerpt = '';
        $this->modalMetaTitle = '';
        $this->modalMetaDescription = '';
        $this->modalFeaturedImage = '';
        $this->modalStatus = 'draft';
        $this->modalPublishedAt = '';
        $this->modalCategoryId = '';
        $this->modalIsFeatured = false;
        $this->modalTags = [];
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetModalForm();
    }

    public function render()
    {
        return view('livewire.backoffice.blog.index', [
            'filterOptions' => $this->filterOptions,
            'tableColumns' => $this->tableColumns,
            'tableActions' => $this->tableActions,
            'data' => $this->data,
            'totalPosts' => $this->totalPosts,
            'publishedPosts' => $this->publishedPosts,
            'draftPosts' => $this->draftPosts,
            'featuredPosts' => $this->featuredPosts,
        ]);
    }
}
