<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class Terms extends Component
{
    public function render()
    {
        return view('livewire.guest.terms')
            ->layout('layouts.guest');
    }
}
