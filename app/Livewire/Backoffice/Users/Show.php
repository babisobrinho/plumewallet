<?php

namespace App\Livewire\Backoffice\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Show extends Component
{
    public User $user;

    public function mount(User $user)
    {
        // Verificar permissões
        $this->authorize('users_read');
        
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.backoffice.users.show');
    }
}
