<?php

namespace App\Livewire\Guest;

use App\Models\Faq;
use App\Enums\FaqCategory;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class Faqs extends Component
{
    public $selectedCategory = null;
    public $search = '';

    public function mount()
    {
        $this->selectedCategory = FaqCategory::GENERAL->value;
    }

    public function updatedSelectedCategory()
    {
        $this->reset('search');
    }

    public function updatedSearch()
    {
        $this->reset('selectedCategory');
    }

    public function getFaqsProperty()
    {
        $query = Faq::active()->ordered();

        if ($this->selectedCategory) {
            $query->byCategory(FaqCategory::from($this->selectedCategory));
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('question', 'like', '%' . $this->search . '%')
                  ->orWhere('answer', 'like', '%' . $this->search . '%');
            });
        }

        return $query->get();
    }

    public function getCategoriesProperty()
    {
        return FaqCategory::cases();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('livewire.guest.faqs');
    }
}
