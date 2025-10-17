<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.client')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.client.dashboard');
    }
}
