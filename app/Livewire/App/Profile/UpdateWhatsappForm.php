<?php

namespace App\Livewire\App\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UpdateWhatsappForm extends Component
{
    public $state = [];

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    public function updateWhatsapp()
    {
        $this->resetErrorBag();

        $user = Auth::user();

        $validated = $this->validate([
            'state.phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        $user->forceFill([
            'phone_number' => $validated['state']['phone_number'] ?? null,
        ])->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.app.profile.update-whatsapp-form');
    }
}
