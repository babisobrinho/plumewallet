<?php

namespace App\Livewire\App\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public function render()
    {
        return view('livewire.app.dashboard.show');
    }
}
