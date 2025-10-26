<?php

namespace App\Livewire\Shared\Partials;

use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public $model;
    public $tableColumns = [];
    public $tableActions = [];
    public $filterOptions = [];
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 15;
    public $page = 1;

    // Filter properties
    public $search = '';
    public $filters = [];
    
    // Individual filter properties for Livewire reactivity
    public $filterStatus = '';
    public $filterCategory = '';
    public $filterAuthor = '';
    public $filterRole = '';
    public $filterType = '';
    public $filterLevel = '';
    public $filterUser = '';
    public $filterCountry = '';
    public $filterSuspicious = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filters' => ['except' => []],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'page' => ['except' => 1],
    ];

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function mount($model, $tableColumns = [], $tableActions = [], $filterOptions = [], $sortBy = 'created_at', $sortDirection = 'desc', $perPage = 15)
    {
        $this->model = $model;
        $this->tableColumns = $tableColumns;
        $this->tableActions = $tableActions;
        $this->filterOptions = $filterOptions;
        $this->sortBy = $sortBy;
        $this->sortDirection = $sortDirection;
        $this->perPage = $perPage;

        // Initialize from query string
        $this->search = request()->query('search', '');
        $this->filters = request()->query('filters', []);
    }

    public function getDataProperty()
    {
        $modelClass = "App\\Models\\" . ucfirst($this->model);
        $normalizedModel = ucfirst($this->model);
        
        if (!class_exists($modelClass)) {
            $modelClass = "App\\Models\\User"; // fallback
            $normalizedModel = 'User';
        }

        $query = $modelClass::query();
        
        // Load relationships based on model
        if ($normalizedModel === 'Post') {
            $query->with(['author']);
        }

        // Apply search
        if ($this->search) {
            $query->where(function ($q) use ($normalizedModel) {
                // Different search fields based on model
                switch ($normalizedModel) {
                    case 'User':
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
                        break;
                    case 'SystemLog':
                        $q->where('message', 'like', '%' . $this->search . '%');
                        break;
                    case 'LoginAttempt':
                        $q->where('email', 'like', '%' . $this->search . '%')
                          ->orWhere('ip_address', 'like', '%' . $this->search . '%');
                        break;
                    case 'Post':
                        $q->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('content', 'like', '%' . $this->search . '%');
                        break;
                    case 'Faq':
                        $q->where('question', 'like', '%' . $this->search . '%')
                          ->orWhere('answer', 'like', '%' . $this->search . '%');
                        break;
                    default:
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
                }
            });
        }

        // Apply filters based on model
        if ($normalizedModel === 'User') {
            $this->applyUserFilters($query);
        } elseif ($normalizedModel === 'Post') {
            $this->applyPostFilters($query);
        } elseif ($normalizedModel === 'Faq') {
            $this->applyFaqFilters($query);
        } elseif ($normalizedModel === 'SystemLog') {
            $this->applySystemLogFilters($query);
        } elseif ($normalizedModel === 'LoginAttempt') {
            $this->applyLoginAttemptFilters($query);
        }

        // Apply sorting
        if ($this->sortBy) {
            $query->orderBy($this->sortBy, $this->sortDirection);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate($this->perPage);
    }

    protected function applyUserFilters($query)
    {
        $status = $this->filterStatus ?? ($this->filters['status'] ?? '');
        $role = $this->filterRole ?? ($this->filters['role'] ?? '');
        
        if ($status && $status !== '' && $status !== null) {
            if ($status === 'active') {
                $query->whereNotNull('email_verified_at');
            } elseif ($status === 'inactive') {
                $query->whereNull('email_verified_at');
            }
        }

        if ($role && $role !== '' && $role !== null) {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('type', $role);
            });
        }
    }

    protected function applyPostFilters($query)
    {
        $status = $this->filterStatus ?? ($this->filters['status'] ?? '');
        $category = $this->filterCategory ?? ($this->filters['category'] ?? '');
        $author = $this->filterAuthor ?? ($this->filters['author'] ?? '');
        
        if ($status && $status !== '' && $status !== null) {
            $query->where('status', $status);
        }

        if ($category && $category !== '' && $category !== null) {
            $query->where('category', $category);
        }

        if ($author && $author !== '' && $author !== null) {
            $query->where('author_id', $author);
        }
    }

    protected function applyFaqFilters($query)
    {
        $category = $this->filterCategory ?? ($this->filters['category'] ?? '');
        $status = $this->filterStatus ?? ($this->filters['status'] ?? '');
        
        if ($category && $category !== '' && $category !== null) {
            $query->where('category', $category);
        }

        if ($status && $status !== '' && $status !== null) {
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }
    }

    protected function applySystemLogFilters($query)
    {
        $type = $this->filterType ?? ($this->filters['type'] ?? '');
        $level = $this->filterLevel ?? ($this->filters['level'] ?? '');
        $user = $this->filterUser ?? ($this->filters['user'] ?? '');
        
        if ($type && $type !== '' && $type !== null) {
            $query->where('type', $type);
        }

        if ($level && $level !== '' && $level !== null) {
            $query->where('level', $level);
        }

        if ($user && $user !== '' && $user !== null) {
            $query->where('user_id', $user);
        }
    }

    protected function applyLoginAttemptFilters($query)
    {
        $status = $this->filterStatus ?? ($this->filters['status'] ?? '');
        $country = $this->filterCountry ?? ($this->filters['country'] ?? '');
        $suspicious = $this->filterSuspicious ?? ($this->filters['suspicious'] ?? '');
        
        if ($status && $status !== '' && $status !== null) {
            $query->where('status', $status);
        }

        if ($country && $country !== '' && $country !== null) {
            $query->where('country', $country);
        }

        if ($suspicious !== '' && $suspicious !== null) {
            $query->where('is_suspicious', $suspicious);
        }
    }

    public function sortColumn($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function updatedFilterCategory()
    {
        $this->resetPage();
    }

    public function updatedFilterAuthor()
    {
        $this->resetPage();
    }

    public function updatedFilterRole()
    {
        $this->resetPage();
    }

    public function updatedFilterType()
    {
        $this->resetPage();
    }

    public function updatedFilterLevel()
    {
        $this->resetPage();
    }

    public function updatedFilterUser()
    {
        $this->resetPage();
    }

    public function updatedFilterCountry()
    {
        $this->resetPage();
    }

    public function updatedFilterSuspicious()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filters = [];
        $this->filterStatus = '';
        $this->filterCategory = '';
        $this->filterAuthor = '';
        $this->filterRole = '';
        $this->filterType = '';
        $this->filterLevel = '';
        $this->filterUser = '';
        $this->filterCountry = '';
        $this->filterSuspicious = '';
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }


    // Generic action methods that emit events to parent component
    public function editItem($id)
    {
        $this->dispatch('editItem', $id);
    }

    public function deleteItem($id)
    {
        $this->dispatch('deleteItem', $id);
    }

    public function viewItem($id)
    {
        $this->dispatch('viewItem', $id);
    }

    public function toggleFeatured($id)
    {
        $this->dispatch('toggleFeatured', $id);
    }

    public function toggleStatus($id)
    {
        $this->dispatch('toggleStatus', $id);
    }

    public function blockItem($id)
    {
        $this->dispatch('blockItem', $id);
    }

    public function unblockItem($id)
    {
        $this->dispatch('unblockItem', $id);
    }

    public function getGenericMethod($method)
    {
        $methodMap = [
            'editPost' => 'editItem',
            'editUser' => 'editItem',
            'editFaq' => 'editItem',
            'deletePost' => 'deleteItem',
            'deleteUser' => 'deleteItem',
            'deleteFaq' => 'deleteItem',
            'deleteAttempt' => 'deleteItem',
            'deleteLog' => 'deleteItem',
            'viewUser' => 'viewItem',
            'viewAttempt' => 'viewItem',
            'viewLog' => 'viewItem',
            'toggleFeatured' => 'toggleFeatured',
            'toggleStatus' => 'toggleStatus',
            'blockIp' => 'blockItem',
            'unblockIp' => 'unblockItem',
        ];

        return $methodMap[$method] ?? $method;
    }

    public function render()
    {
        return view('livewire.shared.partials.data-table', [
            'data' => $this->getDataProperty(),
        ]);
    }
}