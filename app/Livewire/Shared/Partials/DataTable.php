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
        
        if (!class_exists($modelClass)) {
            $modelClass = "App\\Models\\User"; // fallback
        }

        $query = $modelClass::query();

        // Apply search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Apply filters based on model
        if ($this->model === 'user') {
            $this->applyUserFilters($query);
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
        if (isset($this->filters['status']) && $this->filters['status']) {
            if ($this->filters['status'] === 'active') {
                $query->whereNotNull('email_verified_at');
            } elseif ($this->filters['status'] === 'inactive') {
                $query->whereNull('email_verified_at');
            }
        }

        if (isset($this->filters['role']) && $this->filters['role']) {
            $query->whereHas('roles', function ($q) {
                $q->where('type', $this->filters['role']);
            });
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

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filters = [];
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.shared.partials.data-table', [
            'data' => $this->getDataProperty(),
        ]);
    }
}