<?php

namespace App\Livewire\Backoffice\Users;

use App\Models\User;
use App\Enums\RoleType;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

#[Layout('layouts.backoffice')]
class Create extends Component
{
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role_type' => ['required', 'in:staff,client'],
            'is_active' => ['boolean'],
        ];
    }

    public function mount()
    {
        // Verificar permissões
        $this->authorize('users_create');
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'password' => Hash::make($this->password),
            'email_verified_at' => $this->is_active ? now() : null,
        ]);

        // Atribuir role baseado no tipo
        $roleName = $this->role_type === 'staff' ? 'admin' : 'regular';
        $user->assignRole($roleName);

        session()->flash('message', 'Utilizador criado com sucesso.');

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
        return view('livewire.backoffice.users.create', [
            'roleTypeOptions' => $this->roleTypeOptions
        ]);
    }
}
