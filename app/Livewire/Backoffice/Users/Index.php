<?php

namespace App\Livewire\Backoffice\Users;

use App\Models\User;
use App\Enums\RoleType;
use App\Actions\Fortify\CreateNewUser;
use App\Services\LoggingService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    use WithPagination;

    // Search and filters
    public $search = '';
    public $filters = [
        'status' => '',
        'role' => '',
    ];

    // Modal properties only - no more table/filter logic
    public $showModal = false;
    public $isEditing = false;
    public $editingUser = null;
    
    // Confirmation modal properties
    public $confirmingUserDeletion = false;
    public $userToDelete = null;
    public $confirmName = '';
    
    // Modal form fields
    public $modalName = '';
    public $modalEmail = '';
    public $modalPhoneNumber = '';
    public $modalPassword = '';
    public $modalPasswordConfirmation = '';
    public $modalRoleType = '';
    public $modalRole = '';

    protected $listeners = [
        'refreshTable' => '$refresh',
        'editItem' => 'editUser',
        'deleteItem' => 'deleteUser',
        'viewItem' => 'viewUser',
    ];
    
    public function mount()
    {
        $this->authorize('users_read');
    }

    public function getFilterOptionsProperty()
    {
        return [
            [
                'key' => 'status',
                'label' => __('common.labels.status'),
                'type' => 'select',
                'placeholder' => __('users.filters.all_status'),
                'options' => [
                    'active' => __('enums.status.active'),
                    'inactive' => __('enums.status.inactive'),
                ]
            ],
            [
                'key' => 'role',
                'label' => __('users.filters.user_type'),
                'type' => 'select',
                'placeholder' => __('users.filters.all_types'),
                'options' => [
                    'staff' => __('enums.role_type.staff'),
                    'client' => __('enums.role_type.client'),
                ]
            ]
        ];
    }

    public function getTableColumnsProperty()
    {
        return [
            [
                'key' => 'name',
                'label' => __('common.labels.name'),
                'sortable' => true,
            ],
            [
                'key' => 'email',
                'label' => __('common.labels.email'),
                'sortable' => true,
            ],
            [
                'key' => 'roles',
                'label' => __('common.labels.type'),
                'component' => 'livewire.backoffice.users.partials.role-badge',
                'sortable' => false,
            ],
            [
                'key' => 'email_verified_at',
                'label' => __('common.labels.verified'),
                'format' => 'boolean',
                'sortable' => true,
            ],
            [
                'key' => 'created_at',
                'label' => __('common.labels.registered_at'),
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
                        'label' => __('common.buttons.view'),
                        'icon' => 'eye',
                        'method' => 'viewUser',
                    ],
                    [
                        'label' => __('common.buttons.edit'),
                        'icon' => 'pencil',
                        'method' => 'editUser',
                    ],
                    [
                        'label' => __('common.buttons.delete'),
                        'icon' => 'trash',
                        'method' => 'deleteUser',
                    ],
                ]
            ]
        ];
    }

    public function getRoleOptionsProperty()
    {
        if (!$this->modalRoleType) {
            return [];
        }

        $roles = \Spatie\Permission\Models\Role::where('type', $this->modalRoleType)->get();
        
        Log::info('Available roles for type ' . $this->modalRoleType . ':', $roles->pluck('name')->toArray());
        
        return $roles->mapWithKeys(function ($role) {
            return [$role->name => $role->name];
        })->toArray();
    }

    // Metric properties
    public function getTotalUsersProperty()
    {
        return User::count();
    }

    public function getActiveUsersProperty()
    {
        return User::whereNotNull('email_verified_at')->count();
    }

    public function getStaffUsersProperty()
    {
        return User::whereHas('roles', function($query) {
            $query->where('type', 'staff');
        })->count();
    }

    public function getClientUsersProperty()
    {
        return User::whereHas('roles', function($query) {
            $query->where('type', 'client');
        })->count();
    }

    public function getDataProperty()
    {
        $query = User::with(['roles'])
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->filters['status'] === 'active', function($query) {
                $query->whereNotNull('email_verified_at');
            })
            ->when($this->filters['status'] === 'inactive', function($query) {
                $query->whereNull('email_verified_at');
            })
            ->when($this->filters['role'], function($query) {
                $query->whereHas('roles', function($q) {
                    $q->where('type', $this->filters['role']);
                });
            });

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filters = [
            'status' => '',
            'role' => '',
        ];
        $this->resetPage();
    }

    public function updatedModalRoleType()
    {
        $this->modalRole = '';
    }

    public function viewUser($userId)
    {
        return redirect()->route('backoffice.users.show', $userId);
    }

    public function editUser($userId)
    {
        $this->authorize('users_update');
        
        $this->isEditing = true;
        $this->editingUser = User::findOrFail($userId);
        $this->loadUserData();
        $this->showModal = true;
    }

    public function createUser()
    {
        $this->authorize('users_create');
        
        $this->isEditing = false;
        $this->editingUser = null;
        $this->resetModalForm();
        $this->showModal = true;
    }

    public function confirmUserDeletion($userId)
    {
        $this->userToDelete = User::findOrFail($userId);
        
        // Prevent users from deleting themselves
        if ($this->userToDelete->id === Auth::id()) {
            session()->flash('error', __('users.messages.cannot_delete_self'));
            return;
        }
        
        $this->confirmingUserDeletion = true;
        $this->confirmName = '';
    }

    public function deleteUser()
    {
        $this->authorize('users_destroy');
        
        if (!$this->userToDelete) {
            session()->flash('error', __('users.messages.user_not_found'));
            return;
        }
        
        // Validate that the user entered the correct name
        if ($this->confirmName !== $this->userToDelete->name) {
            $this->addError('confirmName', __('users.danger_zone.name_mismatch'));
            return;
        }
        
        // Prevent users from deleting themselves
        if ($this->userToDelete->id === Auth::id()) {
            session()->flash('error', __('users.messages.cannot_delete_self'));
            return;
        }
        
        $userName = $this->userToDelete->name;
        $userEmail = $this->userToDelete->email;
        
        // Log user deletion
        LoggingService::deleted('User', [
            'user_id' => $this->userToDelete->id,
            'name' => $userName,
            'email' => $userEmail,
            'deleted_by' => Auth::id()
        ]);
        
        $this->userToDelete->delete();
        
        session()->flash('message', __('users.messages.user_deleted'));
        $this->dispatch('refreshTable');
        
        // Reset modal state
        $this->confirmingUserDeletion = false;
        $this->userToDelete = null;
        $this->confirmName = '';
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetModalForm();
        $this->editingUser = null;
        $this->isEditing = false;
    }

    public function resetModalForm()
    {
        $this->modalName = '';
        $this->modalEmail = '';
        $this->modalPhoneNumber = '';
        $this->modalPassword = '';
        $this->modalPasswordConfirmation = '';
        $this->modalRoleType = '';
        $this->modalRole = '';
        $this->resetErrorBag();
    }

    public function loadUserData()
    {
        $this->modalName = $this->editingUser->name;
        $this->modalEmail = $this->editingUser->email;
        $this->modalPhoneNumber = $this->editingUser->phone_number;
        
        $role = $this->editingUser->roles->first();
        $this->modalRoleType = $role ? $role->type : 'client';
        $this->modalRole = $role ? $role->name : '';
    }

    public function saveUser()
    {
        Log::info('Form data before validation:', [
            'modalName' => $this->modalName,
            'modalEmail' => $this->modalEmail,
            'modalPhoneNumber' => $this->modalPhoneNumber,
            'modalRoleType' => $this->modalRoleType,
            'modalRole' => $this->modalRole,
            'modalPassword' => $this->modalPassword ? '***' : 'empty',
            'modalPasswordConfirmation' => $this->modalPasswordConfirmation ? '***' : 'empty',
            'isEditing' => $this->isEditing
        ]);

        $this->validate([
            'modalName' => ['required', 'string', 'max:255'],
            'modalEmail' => ['required', 'string', 'email', 'max:255'],
            'modalPhoneNumber' => ['nullable', 'string', 'max:20'],
            'modalRoleType' => ['required', 'in:staff,client'],
            'modalRole' => ['required', 'string'],
        ]);

        if ($this->isEditing) {
            $this->validate([
                'modalEmail' => ['unique:users,email,' . $this->editingUser->id],
                'modalPassword' => ['nullable', \Illuminate\Validation\Rules\Password::defaults()],
                'modalPasswordConfirmation' => ['nullable', 'same:modalPassword'],
            ]);
            $this->updateUser();
        } else {
            $this->validate([
                'modalEmail' => ['unique:users,email'],
                'modalPassword' => ['required', \Illuminate\Validation\Rules\Password::defaults()],
                'modalPasswordConfirmation' => ['required', 'same:modalPassword'],
            ]);
            $this->createUserData();
        }

        $this->closeModal();
        $this->dispatch('refreshTable');
    }

    public function createUserData()
    {
        Log::info('Creating user with data:', [
            'name' => $this->modalName,
            'email' => $this->modalEmail,
            'role' => $this->modalRole,
            'role_type' => $this->modalRoleType,
            'password_length' => strlen($this->modalPassword),
            'password_confirmation_length' => strlen($this->modalPasswordConfirmation),
            'passwords_match' => $this->modalPassword === $this->modalPasswordConfirmation
        ]);

        if ($this->modalRoleType === 'client') {
            $this->createClientUser();
        } else {
            $this->createStaffUser();
        }
    }

    private function createClientUser()
    {
        try {
            $fortifyAction = new CreateNewUser();
            
            $user = $fortifyAction->create([
                'name' => $this->modalName,
                'email' => $this->modalEmail,
                'password' => $this->modalPassword,
                'password_confirmation' => $this->modalPasswordConfirmation,
                'terms' => true,
            ]);

            $user->update([
                'phone_number' => $this->modalPhoneNumber,
                // Don't set email_verified_at - let user verify email
            ]);

            // Always assign the selected role, even if it's 'regular'
            $user->syncRoles([$this->modalRole]);

            // Send email verification
            $user->sendEmailVerificationNotification();

            Log::info('Client user created with ID: ' . $user->id . ' and role: ' . $this->modalRole);
            
            // Log user creation
            LoggingService::created('User', [
                'user_id' => $user->id,
                'name' => $this->modalName,
                'email' => $this->modalEmail,
                'role' => $this->modalRole,
                'role_type' => $this->modalRoleType,
                'created_by' => Auth::id()
            ]);
            
            session()->flash('message', __('users.messages.user_created'));
        } catch (\Exception $e) {
            Log::error('Client user creation failed: ' . $e->getMessage());
            session()->flash('error', 'Failed to create client user: ' . $e->getMessage());
        }
    }

    private function createStaffUser()
    {
        try {
            $user = User::create([
                'name' => $this->modalName,
                'email' => $this->modalEmail,
                'phone_number' => $this->modalPhoneNumber,
                'password' => \Illuminate\Support\Facades\Hash::make($this->modalPassword),
                // Don't set email_verified_at - let user verify email
            ]);

            $user->assignRole($this->modalRole);

            // Send email verification
            $user->sendEmailVerificationNotification();

            Log::info('Staff user created with ID: ' . $user->id . ' and role: ' . $this->modalRole);
            
            // Log user creation
            LoggingService::created('User', [
                'user_id' => $user->id,
                'name' => $this->modalName,
                'email' => $this->modalEmail,
                'role' => $this->modalRole,
                'role_type' => $this->modalRoleType,
                'created_by' => Auth::id()
            ]);
            
            session()->flash('message', __('users.messages.user_created'));
        } catch (\Exception $e) {
            Log::error('Staff user creation failed: ' . $e->getMessage());
            session()->flash('error', 'Failed to create staff user: ' . $e->getMessage());
        }
    }

    public function updateUser()
    {
        $updateData = [
            'name' => $this->modalName,
            'email' => $this->modalEmail,
            'phone_number' => $this->modalPhoneNumber,
        ];

        if ($this->modalPassword) {
            $updateData['password'] = \Illuminate\Support\Facades\Hash::make($this->modalPassword);
        }

        $oldData = [
            'name' => $this->editingUser->name,
            'email' => $this->editingUser->email,
            'phone_number' => $this->editingUser->phone_number,
        ];
        
        $this->editingUser->update($updateData);

        $currentRole = $this->editingUser->roles->first();
        
        if (!$currentRole || $currentRole->name !== $this->modalRole) {
            $this->editingUser->syncRoles([$this->modalRole]);
        }

        // Log user update
        LoggingService::updated('User', [
            'user_id' => $this->editingUser->id,
            'name' => $this->modalName,
            'email' => $this->modalEmail,
            'role' => $this->modalRole,
            'updated_by' => Auth::id()
        ], $oldData);

        session()->flash('message', __('users.messages.user_updated'));
    }

    public function render()
    {
        return view('livewire.backoffice.users.index', [
            'data' => $this->data,
            'filterOptions' => $this->filterOptions,
            'tableColumns' => $this->tableColumns,
            'tableActions' => $this->tableActions,
            'roleOptions' => $this->roleOptions,
            'totalUsers' => $this->totalUsers,
            'activeUsers' => $this->activeUsers,
            'staffUsers' => $this->staffUsers,
            'clientUsers' => $this->clientUsers,
        ]);
    }
}