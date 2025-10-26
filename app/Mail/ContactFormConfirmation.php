<?php

namespace App\Mail;

use App\Models\ContactForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public ContactForm $contactForm;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactForm $contactForm)
    {
        $this->contactForm = $contactForm;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Set the locale based on the user's preferred language
        $locale = match($this->contactForm->preferred_language->value) {
            'en' => 'en',
            'pt' => 'pt',
            'fr' => 'fr',
            default => 'en'
        };
        
        app()->setLocale($locale);
        
        return new Envelope(
            subject: __('contact.confirmation.subject', ['process_number' => $this->contactForm->process_number]),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Set the locale based on the user's preferred language
        $locale = match($this->contactForm->preferred_language->value) {
            'en' => 'en',
            'pt' => 'pt',
            'fr' => 'fr',
            default => 'en'
        };
        
        app()->setLocale($locale);
        
        return new Content(
            view: 'emails.contact-form-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
