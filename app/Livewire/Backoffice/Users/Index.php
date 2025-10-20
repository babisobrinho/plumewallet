<?php

namespace App\Livewire\Backoffice\Users;

use App\Models\User;
use App\Enums\RoleType;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $roleFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'roleFilter' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        // Verificar permissões
        $this->authorize('users_read');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedRoleFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->roleFilter = '';
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    public function getUsersProperty()
    {
        $query = User::query();

        // Aplicar filtros
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            if ($this->statusFilter === 'active') {
                $query->whereNotNull('email_verified_at');
            } elseif ($this->statusFilter === 'inactive') {
                $query->whereNull('email_verified_at');
            }
        }

        if ($this->roleFilter) {
            $query->whereHas('roles', function ($q) {
                $q->where('type', $this->roleFilter);
            });
        }

        // Aplicar ordenação
        $query->orderBy($this->sortBy, $this->sortDirection);

        return $query->paginate(15);
    }

    public function getFilterOptionsProperty()
    {
        return [
            [
                'label' => 'Status',
                'type' => 'select',
                'model' => 'statusFilter',
                'placeholder' => 'Todos os status',
                'options' => [
                    'active' => 'Ativo',
                    'inactive' => 'Inativo',
                ]
            ],
            [
                'label' => 'Tipo de Utilizador',
                'type' => 'select',
                'model' => 'roleFilter',
                'placeholder' => 'Todos os tipos',
                'options' => [
                    'staff' => 'Staff',
                    'client' => 'Cliente',
                ]
            ]
        ];
    }

    public function getSortOptionsProperty()
    {
        return [
            ['field' => 'name', 'label' => 'Nome'],
            ['field' => 'email', 'label' => 'Email'],
            ['field' => 'created_at', 'label' => 'Data de Registo'],
            ['field' => 'email_verified_at', 'label' => 'Data de Verificação'],
        ];
    }

    public function getTableColumnsProperty()
    {
        return [
            [
                'key' => 'name',
                'label' => 'Nome',
                'sortable' => true,
            ],
            [
                'key' => 'email',
                'label' => 'Email',
                'sortable' => true,
            ],
            [
                'key' => 'roles',
                'label' => 'Tipo',
                'component' => 'livewire.backoffice.users.partials.role-badge',
            ],
            [
                'key' => 'email_verified_at',
                'label' => 'Status',
                'format' => 'boolean',
            ],
            [
                'key' => 'created_at',
                'label' => 'Registado em',
                'format' => 'datetime',
                'sortable' => true,
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
                        'label' => 'Ver Detalhes',
                        'icon' => 'eye',
                        'method' => 'viewUser',
                    ],
                    [
                        'label' => 'Editar',
                        'icon' => 'pencil',
                        'method' => 'editUser',
                    ],
                    [
                        'label' => 'Eliminar',
                        'icon' => 'trash',
                        'method' => 'deleteUser',
                        'condition' => fn($user) => $user->id !== auth()->id(),
                    ],
                ]
            ]
        ];
    }

    public function viewUser($userId)
    {
        return redirect()->route('backoffice.users.show', $userId);
    }

    public function editUser($userId)
    {
        return redirect()->route('backoffice.users.edit', $userId);
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        
        // Verificar permissões
        $this->authorize('users_destroy');
        
        $user->delete();
        
        session()->flash('message', 'Utilizador eliminado com sucesso.');
    }

    public function render()
    {
        return view('livewire.backoffice.users.index', [
            'users' => $this->users,
            'filterOptions' => $this->filterOptions,
            'sortOptions' => $this->sortOptions,
            'tableColumns' => $this->tableColumns,
            'tableActions' => $this->tableActions,
        ]);
    }
}
