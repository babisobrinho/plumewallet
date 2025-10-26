<?php

namespace App\Livewire\Guest;

use App\Models\Post;
use App\Enums\PostCategory;
use App\Enums\PostTag;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $selectedTag = '';
    public $sortBy = 'published_at';
    public $sortDirection = 'desc';
    public $perPage = 9;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'published_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
        \Log::info('Search updated to: ' . $this->search);
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
        \Log::info('Category updated to: ' . $this->selectedCategory);
    }

    public function updatedSelectedTag()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'desc';
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->selectedTag = '';
        $this->sortBy = 'published_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    public function getPostsProperty()
    {
        \Log::info('Getting posts with search: "' . $this->search . '" and category: ' . $this->selectedCategory);
        
        $query = Post::published()
            ->with(['author'])
            ->when($this->search, function ($query) {
                \Log::info('Applying search filter for: ' . $this->search);
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%')
                      ->orWhereHas('author', function ($authorQuery) {
                          $authorQuery->where('name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhere(function ($tagQuery) {
                          $tagQuery->whereJsonContains('tags', $this->search)
                                   ->orWhereRaw("JSON_SEARCH(tags, 'one', ?) IS NOT NULL", ['%' . $this->search . '%']);
                      });
                });
            })
            ->when($this->selectedCategory, function ($query) {
                $query->byCategory($this->selectedCategory);
            })
            ->when($this->selectedTag, function ($query) {
                $query->byTag($this->selectedTag);
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        $result = $query->paginate($this->perPage);
        \Log::info('Posts count: ' . $result->count());
        
        return $result;
    }

    public function getFeaturedPostsProperty()
    {
        return Post::published()
            ->featured()
            ->with(['author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    }

    public function getPopularPostsProperty()
    {
        return Post::published()
            ->with(['author'])
            ->orderBy('view_count', 'desc')
            ->limit(5)
            ->get();
    }

    public function getCategoriesProperty()
    {
        return PostCategory::cases();
    }

    public function getTagsProperty()
    {
        return PostTag::cases();
    }

    public function getCategoryPostsCountProperty()
    {
        $counts = [];
        foreach (PostCategory::cases() as $category) {
            $counts[$category->value] = Post::published()
                ->byCategory($category)
                ->count();
        }
        return $counts;
    }

    public function render()
    {
        return view('livewire.guest.blog', [
            'posts' => $this->posts,
            'featuredPosts' => $this->featuredPosts,
            'popularPosts' => $this->popularPosts,
            'categories' => $this->categories,
            'tags' => $this->tags,
            'categoryPostsCount' => $this->categoryPostsCount,
        ])->layout('layouts.guest');
    }
}
