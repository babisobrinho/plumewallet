<?php

namespace App\Livewire\Shared\Profile;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    public $user;
    public $state = [];
    public $photo;
    public $verificationLinkSent = false;

    public function mount()
    {
        $this->user = Auth::user();
        $this->state = $this->user->withoutRelations()->toArray();
    }

    public function updateProfileInformation(UpdateUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        // Handle photo upload if present
        if ($this->photo) {
            $this->state['photo'] = $this->photo;
        }

        $updater->update($this->user, $this->state);

        if (isset($this->photo)) {
            return redirect()->route('profile.show');
        }

        $this->dispatch('saved');
    }

    public function deleteProfilePhoto()
    {
        $this->user->deleteProfilePhoto();
    }

    public function sendEmailVerification()
    {
        if ($this->user instanceof MustVerifyEmail && ! $this->user->hasVerifiedEmail()) {
            $this->user->sendEmailVerificationNotification();

            $this->verificationLinkSent = true;
        }
    }

    public function render()
    {
        return view('livewire.shared.profile.update-profile-information-form');
    }
}
