<?php

namespace App\Livewire\Backoffice\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Show extends Component
{
    public function render()
    {
        return view('livewire.backoffice.dashboard.show');
    }
}
