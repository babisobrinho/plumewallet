<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class AboutUs extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('livewire.guest.about-us');
    }
}
