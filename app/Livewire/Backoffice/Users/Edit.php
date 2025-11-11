<?php

namespace App\Livewire\Backoffice\Users;

use App\Models\User;
use App\Services\LoggingService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.backoffice')]
class Edit extends Component
{
    public User $user;
    
    // Form fields
    public $name = '';
    public $email = '';
    public $phoneNumber = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $roleType = '';
    public $role = '';

    public function mount(User $user)
    {
        $this->authorize('users_update');
        $this->user = $user;
        $this->loadUserData();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'phoneNumber' => ['nullable', 'string', 'max:20'],
            'roleType' => ['required', 'in:staff,client'],
            'role' => ['required', 'string'],
            'password' => ['nullable', \Illuminate\Validation\Rules\Password::defaults()],
            'passwordConfirmation' => ['nullable', 'same:password'],
        ];
    }

    public function loadUserData()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phoneNumber = $this->user->phone_number;
        
        $userRole = $this->user->roles->first();
        $this->roleType = $userRole ? $userRole->type : 'client';
        $this->role = $userRole ? $userRole->name : '';
    }

    public function getRoleOptionsProperty()
    {
        if (!$this->roleType) {
            return [];
        }

        $roles = \Spatie\Permission\Models\Role::where('type', $this->roleType)->get();
        
        return $roles->mapWithKeys(function ($role) {
            return [$role->name => $role->name];
        })->toArray();
    }

    public function updatedRoleType()
    {
        $this->role = '';
    }

    public function update()
    {
        $this->validate();

        Log::info('Updating user with data:', [
            'user_id' => $this->user->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'role_type' => $this->roleType,
            'role' => $this->role,
            'has_password' => !empty($this->password),
        ]);

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
        ];

        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }

        $oldData = [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'phone_number' => $this->user->phone_number,
        ];
        
        $this->user->update($updateData);

        $currentRole = $this->user->roles->first();
        
        if (!$currentRole || $currentRole->name !== $this->role) {
            $this->user->syncRoles([$this->role]);
        }

        // Log user update
        LoggingService::updated('User', [
            'user_id' => $this->user->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'role' => $this->role,
            'role_type' => $this->roleType,
            'updated_by' => Auth::id()
        ], $oldData);

        session()->flash('message', __('users.messages.user_updated'));
        
        return redirect()->route('backoffice.users.index');
    }

    public function render()
    {
        return view('livewire.backoffice.users.edit', [
            'roleOptions' => $this->roleOptions,
        ]);
    }
}
