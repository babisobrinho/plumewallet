<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class Security extends Component
{
    public function render()
    {
        return view('livewire.guest.security')
            ->layout('layouts.guest');
    }
}
