<?php

namespace App\Livewire\Backoffice\ContactForms;

use App\Enums\ContactFormStatus;
use App\Models\ContactForm;
use App\Models\ContactFormObservation;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.backoffice')]
class Show extends Component
{
    public ContactForm $contactForm;
    
    // Status update
    public $newStatus = '';
    
    // Observation modal
    public $showObservationModal = false;
    public $observationText = '';

    protected $rules = [
        'newStatus' => 'required|string',
        'observationText' => 'required|string|max:1000',
    ];

    public function mount(ContactForm $contactForm)
    {
        $this->authorize('contact_forms_read', $contactForm);
        $this->contactForm = $contactForm;
        $this->newStatus = $contactForm->status->value;
    }

    public function updateStatus()
    {
        $this->authorize('contact_forms_update', $this->contactForm);
        
        $oldStatus = $this->contactForm->status;
        $newStatus = ContactFormStatus::from($this->newStatus);
        
        if ($oldStatus === $newStatus) {
            return;
        }

        $this->contactForm->update(['status' => $newStatus]);

        // Create automatic observation for status change
        ContactFormObservation::create([
            'contact_form_id' => $this->contactForm->id,
            'user_id' => Auth::id(),
            'observation' => "Status changed from " . \App\Enums\ContactFormStatus::label($oldStatus) . " to " . \App\Enums\ContactFormStatus::label($newStatus),
            'status_change' => $newStatus,
        ]);

        session()->flash('message', __('contact.messages.status_updated'));
    }

    public function openObservationModal()
    {
        $this->showObservationModal = true;
        $this->observationText = '';
    }

    public function closeObservationModal()
    {
        $this->showObservationModal = false;
        $this->observationText = '';
        $this->resetErrorBag();
    }

    public function addObservation()
    {
        $this->authorize('contact_forms_update', $this->contactForm);
        
        $this->validate([
            'observationText' => 'required|string|max:1000',
        ]);

        ContactFormObservation::create([
            'contact_form_id' => $this->contactForm->id,
            'user_id' => Auth::id(),
            'observation' => $this->observationText,
        ]);

        session()->flash('message', __('contact.messages.observation_added'));
        $this->closeObservationModal();
    }

    public function getStatusOptionsProperty()
    {
        return collect(ContactFormStatus::cases())
            ->mapWithKeys(fn($status) => [$status->value => ContactFormStatus::label($status)])
            ->toArray();
    }

    public function render()
    {
        return view('livewire.backoffice.contact-forms.show');
    }
}
