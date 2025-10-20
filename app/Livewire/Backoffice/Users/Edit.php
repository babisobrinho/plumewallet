<?php

namespace App\Livewire\Backoffice\Users;

use App\Models\User;
use App\Enums\RoleType;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

#[Layout('layouts.backoffice')]
class Edit extends Component
{
    public User $user;
    public $name = '';
    public $email = '';
    public $phone_number = '';
    public $password = '';
    public $password_confirmation = '';
    public $role_type = '';
    public $is_active = true;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role_type' => ['required', 'in:staff,client'],
            'is_active' => ['boolean'],
        ];
    }

    public function mount(User $user)
    {
        // Verificar permissões
        $this->authorize('users_update');
        
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->is_active = $user->email_verified_at !== null;
        
        // Obter tipo de role atual
        $role = $user->roles->first();
        $this->role_type = $role ? $role->type : 'client';
    }

    public function save()
    {
        $this->validate();

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'email_verified_at' => $this->is_active ? now() : null,
        ];

        // Atualizar palavra-passe apenas se fornecida
        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }

        $this->user->update($updateData);

        // Atualizar role se necessário
        $currentRole = $this->user->roles->first();
        $newRoleName = $this->role_type === 'staff' ? 'admin' : 'regular';
        
        if (!$currentRole || $currentRole->name !== $newRoleName) {
            $this->user->syncRoles([$newRoleName]);
        }

        session()->flash('message', 'Utilizador atualizado com sucesso.');

        return redirect()->route('backoffice.users.index');
    }

    public function getRoleTypeOptionsProperty()
    {
        return [
            'staff' => 'Staff',
            'client' => 'Cliente',
        ];
    }

    public function render()
    {
        return view('livewire.backoffice.users.edit', [
            'roleTypeOptions' => $this->roleTypeOptions
        ]);
    }
}
