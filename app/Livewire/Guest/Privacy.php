<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class Privacy extends Component
{
    public function render()
    {
        return view('livewire.guest.privacy')
            ->layout('layouts.guest');
    }
}
