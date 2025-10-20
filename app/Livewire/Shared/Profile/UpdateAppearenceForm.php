<?php

namespace App\Livewire\Shared\Profile;

use App\Enums\AppTheme;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateAppearenceForm extends Component
{
    public $state = [];

    public function mount()
    {
        $this->state = [
            'theme' => Auth::user()->theme?->value ?? AppTheme::SYSTEM->value,
        ];
    }

    public function updateAppearance()
    {
        $this->resetErrorBag();

        $validated = $this->validate([
            'state.theme' => ['required', 'string', 'in:' . implode(',', AppTheme::values())],
        ]);

        // Get the enum instance
        $theme = AppTheme::fromValue($validated['state']['theme']);

        // Update user's theme preference
        Auth::user()->update([
            'theme' => $theme,
        ]);

        // Apply the theme immediately
        $this->applyTheme($theme);

        $this->dispatch('saved');
    }

    protected function applyTheme(AppTheme $theme)
    {
        if ($theme === AppTheme::SYSTEM) {
            // Remove theme from session to use system preference
            session()->forget('theme');
        } else {
            // Set the theme in session
            session(['theme' => $theme->value]);
        }

        // Update the HTML class immediately via Livewire
        $this->dispatch('theme-changed', theme: $theme->value);
    }

    public function render()
    {
        return view('livewire.shared.profile.update-appearence-form', [
            'themeOptions' => AppTheme::options(),
        ]);
    }
}
