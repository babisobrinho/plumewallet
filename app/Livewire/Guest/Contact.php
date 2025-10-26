<?php

namespace App\Livewire\Guest;

use App\Enums\ContactFormLanguage;
use App\Enums\ContactFormStatus;
use App\Enums\ContactFormSubject;
use App\Mail\ContactFormConfirmation;
use App\Models\ContactForm;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

#[Layout('layouts.guest')]
class Contact extends Component
{
    // Form fields
    public $name = '';
    public $company = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $custom_subject = '';
    public $message = '';
    public $preferred_language = 'en';

    // UI state
    public $showCustomSubject = false;
    public $isSubmitting = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'company' => 'nullable|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'subject' => 'required|string',
        'custom_subject' => 'nullable|string|max:255',
        'message' => 'required|string|max:2000',
        'preferred_language' => 'required|string|in:en,pt,fr',
    ];

    public function mount()
    {
        $this->preferred_language = app()->getLocale();
    }

    public function updatedSubject()
    {
        $this->showCustomSubject = $this->subject === ContactFormSubject::OTHER->value;
        if (!$this->showCustomSubject) {
            $this->custom_subject = '';
        }
    }

    public function submit()
    {
        $this->isSubmitting = true;
        
        // Validate custom subject if "Other" is selected
        if ($this->subject === ContactFormSubject::OTHER->value) {
            $this->rules['custom_subject'] = 'required|string|max:255';
        }

        $this->validate();

        try {
            // Create contact form
            $contactForm = ContactForm::create([
                'process_number' => ContactForm::generateProcessNumber(ContactFormLanguage::from($this->preferred_language)),
                'name' => $this->name,
                'company' => $this->company,
                'email' => $this->email,
                'phone' => $this->phone,
                'subject' => ContactFormSubject::from($this->subject),
                'custom_subject' => $this->custom_subject,
                'message' => $this->message,
                'preferred_language' => ContactFormLanguage::from($this->preferred_language),
                'status' => ContactFormStatus::NEW,
            ]);

            // Send confirmation email to user only
            try {
                \Illuminate\Support\Facades\Log::info('Sending confirmation email to: ' . $contactForm->email);
                \Illuminate\Support\Facades\Log::info('Process number: ' . $contactForm->process_number);
                
                Mail::to($contactForm->email)->send(new ContactFormConfirmation($contactForm));
                
                \Illuminate\Support\Facades\Log::info('Confirmation email sent successfully to: ' . $contactForm->email);
            } catch (\Exception $emailException) {
                \Illuminate\Support\Facades\Log::error('Failed to send confirmation email to: ' . $contactForm->email . ' - Error: ' . $emailException->getMessage());
                \Illuminate\Support\Facades\Log::error('Email exception details: ' . $emailException->getTraceAsString());
                // Don't fail the entire process if confirmation email fails
            }

            session()->flash('success', __('contact.messages.submitted', ['process_number' => $contactForm->process_number]));
            
            // Reset form
            $this->resetForm();
            
        } catch (\Exception $e) {
            session()->flash('error', __('contact.messages.error'));
            \Illuminate\Support\Facades\Log::error('Contact form submission failed: ' . $e->getMessage());
        } finally {
            $this->isSubmitting = false;
        }
    }

    private function resetForm()
    {
        $this->name = '';
        $this->company = '';
        $this->email = '';
        $this->phone = '';
        $this->subject = '';
        $this->custom_subject = '';
        $this->message = '';
        $this->showCustomSubject = false;
    }

    public function getSubjectOptionsProperty()
    {
        return ContactFormSubject::options();
    }

    public function getLanguageOptionsProperty()
    {
        return ContactFormLanguage::options();
    }

    public function render()
    {
        return view('livewire.guest.contact');
    }
}
