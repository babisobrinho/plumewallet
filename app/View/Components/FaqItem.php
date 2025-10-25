<?php

namespace App\View\Components;

use App\Models\Faq;
use Illuminate\View\Component;
use Illuminate\View\View;

class FaqItem extends Component
{
    public Faq $faq;

    /**
     * Create a new component instance.
     */
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.faq-item');
    }
}
