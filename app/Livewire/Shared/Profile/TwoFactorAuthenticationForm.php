<?php

namespace App\Livewire\Shared\Profile;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class TwoFactorAuthenticationForm extends Component
{
    public $showingQrCode = false;
    public $showingConfirmation = false;
    public $showingRecoveryCodes = false;
    public $code = '';

    /**
     * Determine if two factor authentication is enabled.
     *
     * @return bool
     */
    public function getEnabledProperty()
    {
        return !empty(Auth::user()->two_factor_secret);
    }

    /**
     * Get the current user.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Show the two-factor authentication setup.
     *
     * @return void
     */
    public function enableTwoFactorAuthentication()
    {
        $this->resetErrorBag();

        $this->showingConfirmation = true;
        $this->showingQrCode = true;

        // For a real implementation, you would generate a proper 2FA secret here
        // This is a simplified version
        if (empty(Auth::user()->two_factor_secret)) {
            Auth::user()->forceFill([
                'two_factor_secret' => encrypt($this->generateTwoFactorSecret()),
                'two_factor_recovery_codes' => encrypt(json_encode(Collection::times(8, function () {
                    return $this->generateRecoveryCode();
                })->all())),
            ])->save();
        }
    }

    /**
     * Generate a new two factor authentication secret.
     *
     * @return string
     */
    protected function generateTwoFactorSecret()
    {
        // In a real app, you would use: (new \PragmaRX\Google2FA\Google2FA)->generateSecretKey();
        return Str::random(32);
    }

    /**
     * Generate a new recovery code.
     *
     * @return string
     */
    protected function generateRecoveryCode()
    {
        return Str::random(10).'-'.Str::random(10);
    }

    /**
     * Confirm two factor authentication.
     *
     * @return void
     */
    public function confirmTwoFactorAuthentication()
    {
        $this->resetErrorBag();

        if (empty($this->code)) {
            $this->addError('code', __('The two factor authentication code is required.'));
            return;
        }

        // For demo purposes, we'll just accept any code
        // In a real app, you would verify against Google Authenticator
        Auth::user()->forceFill([
            'two_factor_confirmed_at' => now(),
        ])->save();

        $this->showingConfirmation = false;
        $this->showingQrCode = false;
        $this->showingRecoveryCodes = true;
    }

    /**
     * Display the user's recovery codes.
     *
     * @return void
     */
    public function showRecoveryCodes()
    {
        $this->showingRecoveryCodes = true;
    }

    /**
     * Generate new recovery codes for the user.
     *
     * @return void
     */
    public function regenerateRecoveryCodes()
    {
        Auth::user()->forceFill([
            'two_factor_recovery_codes' => encrypt(json_encode(Collection::times(8, function () {
                return $this->generateRecoveryCode();
            })->all())),
        ])->save();

        $this->showingRecoveryCodes = true;
    }

    /**
     * Disable two factor authentication for the user.
     *
     * @return void
     */
    public function disableTwoFactorAuthentication()
    {
        Auth::user()->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = false;
    }

    public function render()
    {
        return view('livewire.shared.profile.two-factor-authentication-form');
    }
}
