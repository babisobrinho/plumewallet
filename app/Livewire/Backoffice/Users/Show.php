<?php

namespace App\Livewire\Backoffice\Users;

use App\Models\User;
use App\Services\LoggingService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.backoffice')]
class Show extends Component
{
    public User $user;
    
    // Confirmation modal properties
    public $confirmingUserDeletion = false;
    public $confirmName = '';

    public function mount(User $user)
    {
        // Verificar permissões
        $this->authorize('users_read');
        
        $this->user = $user;
    }

    public function confirmUserDeletion()
    {
        $this->confirmingUserDeletion = true;
        $this->confirmName = '';
    }

    public function cancelUserDeletion()
    {
        $this->confirmingUserDeletion = false;
        $this->confirmName = '';
        $this->resetErrorBag();
    }

    public function deleteUser()
    {
        $this->authorize('users_destroy');
        
        // Validate that the user entered the correct name
        if ($this->confirmName !== $this->user->name) {
            $this->addError('confirmName', __('users.danger_zone.name_mismatch'));
            return;
        }
        
        // Prevent users from deleting themselves
        if ($this->user->id === Auth::id()) {
            session()->flash('error', __('users.messages.cannot_delete_self'));
            return;
        }
        
        $userName = $this->user->name;
        $userEmail = $this->user->email;
        
        // Log user deletion
        LoggingService::deleted('User', [
            'user_id' => $this->user->id,
            'name' => $userName,
            'email' => $userEmail,
            'deleted_by' => Auth::id()
        ]);
        
        $this->user->delete();
        
        session()->flash('message', __('users.messages.user_deleted'));
        
        // Close the modal
        $this->confirmingUserDeletion = false;
        $this->confirmName = '';
        
        return redirect()->route('backoffice.users.index');
    }

    public function render()
    {
        return view('livewire.backoffice.users.show');
    }
}
