<?php

namespace App\Livewire\Institutional\Homepage;

use Livewire\Component;

class Show extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('livewire.institutional.homepage.show')
            ->layout('layouts.institutional');
    }
}
