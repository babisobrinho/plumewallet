<?php

namespace App\Livewire\Backoffice;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.backoffice')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.backoffice.dashboard');
    }
}
