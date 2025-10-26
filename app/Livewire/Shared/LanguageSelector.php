<?php

namespace App\Livewire\Shared;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LanguageSelector extends Component
{
    public $currentLanguage;
    public $showDropdown = false;

    protected $languages = [
        'en' => 'English',
        'pt' => 'Português',
        'fr' => 'Français',
    ];

    public function mount()
    {
        $this->currentLanguage = App::getLocale();
    }

    public function switchLanguage($locale)
    {
        // Validate locale
        if (!array_key_exists($locale, $this->languages)) {
            return;
        }

        // Set the locale
        App::setLocale($locale);

        // Update user's language preference if authenticated
        if (Auth::check()) {
            Auth::user()->update(['language' => $locale]);
        }

        // Update current language
        $this->currentLanguage = $locale;

        // Refresh the page to apply translations
        return redirect()->to(request()->header('Referer') ?? route('homepage.show'));
    }

    public function render()
    {
        return view('livewire.shared.language-selector', [
            'languages' => $this->languages,
        ]);
    }
}
