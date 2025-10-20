<?php

namespace App\Livewire\Shared\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function updatePassword()
    {
        $this->resetErrorBag();

        $validated = $this->validate([
            'state.current_password' => ['required', 'current_password'],
            'state.password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->forceFill([
            'password' => Hash::make($validated['state']['password']),
        ])->save();

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.shared.profile.update-password-form');
    }
}
