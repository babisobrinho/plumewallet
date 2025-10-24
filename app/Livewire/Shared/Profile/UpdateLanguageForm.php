<?php

namespace App\Livewire\Shared\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class UpdateLanguageForm extends Component
{
    public $state = [];

    public function mount()
    {
        $this->state = [
            'language' => Auth::user()->language ?? 'en',
        ];
    }

    public function updateLanguage()
    {
        $this->resetErrorBag();

        $validated = $this->validate([
            'state.language' => ['required', 'string', 'in:en,pt,fr'],
        ]);

        // Update user's language preference
        Auth::user()->update([
            'language' => $validated['state']['language'],
        ]);

        // Set the language in the application
        App::setLocale($validated['state']['language']);

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.shared.profile.update-language-form', [
            'languageOptions' => $this->getLanguageOptions(),
        ]);
    }

    protected function getLanguageOptions()
    {
        return [
            'en' => __('common.languages.english'),
            'pt' => __('common.languages.portuguese'),
            'fr' => __('common.languages.french'),
        ];
    }
}



