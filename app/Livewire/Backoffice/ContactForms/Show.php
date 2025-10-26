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
    public $observationText = '';
    public $observationStatus = '';
    public $showObservationModal = false;

    protected $rules = [
        'newStatus' => 'required|string',
        'observationText' => 'required|string|max:1000',
        'observationStatus' => 'nullable|string',
    ];

    public function mount(ContactForm $contactForm)
    {
        $this->authorize('contact_forms_read', $contactForm);
        $this->contactForm = $contactForm;
        $this->newStatus = $contactForm->status->value;
        $this->observationStatus = $contactForm->status->value;
    }

    public function openObservationModal()
    {
        $this->showObservationModal = true;
        $this->observationText = '';
        $this->observationStatus = ''; // Always start with empty (Keep current status)
    }

    public function closeObservationModal()
    {
        $this->showObservationModal = false;
        $this->observationText = '';
        $this->observationStatus = ''; // Reset to empty
        $this->resetErrorBag();
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


    public function addObservation()
    {
        \Log::info('addObservation method called - START');
        \Log::info('observationText: ' . $this->observationText);
        \Log::info('observationStatus: ' . $this->observationStatus);
        
        $this->authorize('contact_forms_update', $this->contactForm);
        
        try {
            $this->validate([
                'observationText' => 'required|string|max:1000',
                'observationStatus' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->errors()]);
            throw $e;
        }

        \Log::info('Adding observation', [
            'contact_form_id' => $this->contactForm->id,
            'user_id' => Auth::id(),
            'observation' => $this->observationText,
            'status' => $this->observationStatus,
        ]);

        // Create observation
        try {
            $observationStatus = null;
            if ($this->observationStatus) {
                $observationStatus = ContactFormStatus::from($this->observationStatus);
            }
            
            $observation = ContactFormObservation::create([
                'contact_form_id' => $this->contactForm->id,
                'user_id' => Auth::id(),
                'observation' => $this->observationText,
                'status' => $observationStatus,
            ]);

            \Log::info('Observation created', ['observation_id' => $observation->id]);
        } catch (\Exception $e) {
            \Log::error('Failed to create observation', ['error' => $e->getMessage()]);
            throw $e;
        }

        // Update contact form status if different from current
        if ($this->observationStatus && $this->observationStatus !== $this->contactForm->status->value) {
            $newStatus = ContactFormStatus::from($this->observationStatus);
            $this->contactForm->update(['status' => $newStatus]);
        }

        // Refresh the contact form to get updated observations
        $this->contactForm->refresh();
        $this->contactForm->load('observations.user');

        // Reset the observation fields
        $this->observationText = '';
        $this->observationStatus = $this->contactForm->status->value;
        $this->resetErrorBag();

        session()->flash('message', __('contact.messages.observation_added'));
        
        // Close the modal
        $this->showObservationModal = false;
    }

    public function getStatusOptionsProperty()
    {
        $currentStatus = $this->contactForm->status;
        
        return collect(ContactFormStatus::cases())
            ->filter(fn($status) => $status !== $currentStatus) // Exclude current status
            ->mapWithKeys(fn($status) => [$status->value => ContactFormStatus::label($status)])
            ->toArray();
    }

    public function render()
    {
        return view('livewire.backoffice.contact-forms.show');
    }
}
