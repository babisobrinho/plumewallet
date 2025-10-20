<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconChip extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $size = 'h-8 w-8',
        public string $bgColor = 'bg-gray-100 dark:bg-gray-800',
        public ?string $icon = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icon-chip');
    }
}
