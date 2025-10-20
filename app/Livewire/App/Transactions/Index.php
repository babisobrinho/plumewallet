<?php

namespace App\Livewire\App\Transactions;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.app.transactions.index');
    }
}
