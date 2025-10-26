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
        \Log::info('FAQ Category updated to: ' . $this->selectedCategory);
    }

    public function updatedSearch()
    {
        $this->reset('selectedCategory');
        \Log::info('FAQ Search updated to: ' . $this->search);
    }

    public function getFaqsProperty()
    {
        \Log::info('Getting FAQs with category: ' . $this->selectedCategory . ' and search: ' . $this->search);
        
        $query = Faq::active()->ordered();

        if ($this->selectedCategory) {
            \Log::info('Applying category filter: ' . $this->selectedCategory);
            $query->byCategory(FaqCategory::from($this->selectedCategory));
        }

        if ($this->search) {
            \Log::info('Applying search filter: ' . $this->search);
            $query->where(function ($q) {
                $q->where('question', 'like', '%' . $this->search . '%')
                  ->orWhere('answer', 'like', '%' . $this->search . '%');
            });
        }

        $result = $query->get();
        \Log::info('FAQs count: ' . $result->count());
        
        return $result;
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
