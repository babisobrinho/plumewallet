<?php

namespace App\Livewire\Backoffice\Profile;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    #[Layout('layouts.backoffice')]
    public function render()
    {
        return view('livewire.backoffice.profile.show');
    }
}
