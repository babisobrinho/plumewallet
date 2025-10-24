<?php

namespace App\Livewire\Institutional\AboutUs;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.institutional')]
class Show extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('livewire.institutional.about-us.show');
    }
}
