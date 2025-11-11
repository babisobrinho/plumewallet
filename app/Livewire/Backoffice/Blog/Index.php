<?php

namespace App\Livewire\Backoffice\Blog;

use App\Models\Post;
use App\Models\User;
use App\Enums\PostStatus;
use App\Enums\PostCategory;
use App\Enums\PostTag;
use App\Services\LoggingService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithPagination;

    // Search and filters
    public $search = '';
    public $filters = [
        'status' => '',
        'category' => '',
        'author' => '',
    ];


    protected $listeners = [
        'refreshTable' => '$refresh',
        'deleteItem' => 'deletePost',
        'toggleFeatured' => 'toggleFeatured',
    ];
    
    public function mount()
    {
        $this->authorize('blog_read');
    }

    // Cached filter options to prevent performance issues
    private $cachedFilterOptions = null;

    public function getFilterOptionsProperty()
    {
        if ($this->cachedFilterOptions === null) {
            $this->cachedFilterOptions = [
                [
                    'key' => 'status',
                    'label' => __('blog.filters.status'),
                    'type' => 'select',
                    'placeholder' => __('blog.filters.all_status'),
                    'options' => PostStatus::options()
                ],
                [
                    'key' => 'category',
                    'label' => __('blog.filters.category'),
                    'type' => 'select',
                    'placeholder' => __('blog.filters.all_categories'),
                    'options' => PostCategory::options()
                ],
                [
                    'key' => 'author',
                    'label' => __('blog.filters.author'),
                    'type' => 'select',
                    'placeholder' => __('blog.filters.all_authors'),
                    'options' => $this->authors
                ]
            ];
        }
        return $this->cachedFilterOptions;
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
                'component' => 'components.badge',
                'componentParams' => [
                    'enumClass' => \App\Enums\PostCategory::class,
                    'noValueKey' => 'blog.no_category',
                    'field' => 'category',
                ],
                'sortable' => false,
                'class' => 'w-1/6',
            ],
            [
                'key' => 'author',
                'label' => __('blog.table.author'),
                'component' => 'livewire.backoffice.blog.partials.author-name',
                'sortable' => false,
                'class' => 'w-1/6',
            ],
            [
                'key' => 'status',
                'label' => __('blog.table.status'),
                'component' => 'components.badge',
                'componentParams' => [
                    'enumClass' => \App\Enums\PostStatus::class,
                    'noValueKey' => 'blog.no_status',
                    'field' => 'status',
                ],
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
            // views column removed
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
                        'url' => 'backoffice.blog.edit',
                        'icon' => 'pencil',
                        'params' => ['post' => 'id'],
                    ],
                    [
                        'label' => __('blog.actions.toggle_featured'),
                        'method' => 'toggleFeatured',
                        'icon' => 'star',
                        'dynamic' => true, // This will be handled dynamically in the view
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


    // Cached metrics to avoid multiple database queries
    private $cachedMetrics = null;

    public function getMetricsProperty()
    {
        if ($this->cachedMetrics === null) {
            $this->cachedMetrics = [
                'total' => Post::count(),
                'published' => Post::published()->count(),
                'draft' => Post::draft()->count(),
                'featured' => Post::featured()->published()->count(),
            ];
        }
        return $this->cachedMetrics;
    }

    // Metric properties (now using cached data)
    public function getTotalPostsProperty()
    {
        return $this->metrics['total'];
    }

    public function getPublishedPostsProperty()
    {
        return $this->metrics['published'];
    }

    public function getDraftPostsProperty()
    {
        return $this->metrics['draft'];
    }

    public function getFeaturedPostsProperty()
    {
        return $this->metrics['featured'];
    }

    public function getDataProperty()
    {
        $query = Post::with(['author'])
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->when($this->filters['status'], function($query) {
                $query->where('status', $this->filters['status']);
            })
            ->when($this->filters['category'], function($query) {
                $query->where('category', $this->filters['category']);
            })
            ->when($this->filters['author'], function($query) {
                $query->where('author_id', $this->filters['author']);
            });

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filters = [
            'status' => '',
            'category' => '',
            'author' => '',
        ];
        $this->resetPage();
        
        // Force UI update by dispatching a custom event
        $this->dispatch('filters-cleared');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    // Cache author options to prevent database query in view
    private $cachedAuthors = null;

    public function getAuthorsProperty()
    {
        if ($this->cachedAuthors === null) {
            $this->cachedAuthors = User::whereHas('roles', function($query) {
                $query->where('type', 'staff');
            })->get()->mapWithKeys(function($user) {
                return [$user->id => $user->name];
            })->toArray();
        }
        return $this->cachedAuthors;
    }

    public function sortColumn($column)
    {
        // Implement sorting logic if needed
    }


    public function deletePost($postId)
    {
        $this->authorize('blog_delete');
        
        $post = Post::findOrFail($postId);
        $postTitle = $post->title;
        $post->delete();
        
        // Clear cached metrics
        $this->cachedMetrics = null;
        
        // Log the deletion
        LoggingService::deleted('Blog Post', [
            'post_id' => $postId,
            'title' => $postTitle,
            'author_id' => $post->author_id,
            'status' => $post->status->value,
            'is_featured' => $post->is_featured
        ]);
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('blog.messages.deleted_successfully'));
    }

    public function toggleFeatured($postId)
    {
        $this->authorize('blog_update');
        
        $post = Post::findOrFail($postId);
        $wasFeatured = $post->is_featured;
        $post->update(['is_featured' => !$post->is_featured]);
        
        // Clear cached metrics
        $this->cachedMetrics = null;
        
        // Log the featured status change
        LoggingService::userActivity("Blog post featured status changed: {$post->title}", [
            'post_id' => $post->id,
            'title' => $post->title,
            'was_featured' => $wasFeatured,
            'is_featured' => !$wasFeatured,
            'user_id' => Auth::id(),
        ]);
        
        $this->dispatch('refreshTable');
        session()->flash('message', __('blog.messages.featured_toggled'));
    }


    public function render()
    {
        return view('livewire.backoffice.blog.index', [
            'data' => $this->data,
            'filterOptions' => $this->filterOptions,
            'tableColumns' => $this->tableColumns,
            'tableActions' => $this->tableActions,
            'totalPosts' => $this->totalPosts,
            'publishedPosts' => $this->publishedPosts,
            'draftPosts' => $this->draftPosts,
            'featuredPosts' => $this->featuredPosts,
        ]);
    }
}
