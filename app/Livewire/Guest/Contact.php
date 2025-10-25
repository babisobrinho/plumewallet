<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;

#[Layout('layouts.guest')]
class Contact extends Component
{
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|string|min:10')]
    public $phone = '';

    #[Validate('nullable|string|max:255')]
    public $name = '';

    #[Validate('required|string|min:10')]
    public $message = '';

    public $isSubmitting = false;
    public $submitted = false;

    public function submit()
    {
        $this->validate();

        $this->isSubmitting = true;

        try {
            // Prepare email content with all form data
            $emailContent = "New Contact Form Submission\n\n";
            $emailContent .= "Name: " . ($this->name ?: 'Not provided') . "\n";
            $emailContent .= "Email: " . $this->email . "\n";
            $emailContent .= "Phone: " . $this->phone . "\n";
            $emailContent .= "Message:\n" . $this->message . "\n";

            // Send email
            Mail::raw($emailContent, function ($mail) {
                $mail->to('contact@plume.pt')
                    ->subject('Contact Form Submission from ' . ($this->name ?: 'Anonymous'))
                    ->replyTo($this->email);
            });

            $this->submitted = true;
            $this->reset(['email', 'phone', 'name', 'message']);
        } catch (\Exception $e) {
            session()->flash('error', 'There was an error sending your message. Please try again.');
        } finally {
            $this->isSubmitting = false;
        }
    }

    public function render()
    {
        return view('livewire.guest.contact');
    }
}
