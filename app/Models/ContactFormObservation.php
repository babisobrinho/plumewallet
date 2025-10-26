<?php

namespace App\Models;

use App\Enums\ContactFormStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactFormObservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_form_id',
        'user_id',
        'observation',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => ContactFormStatus::class,
        ];
    }

    /**
     * Get the contact form that owns the observation.
     */
    public function contactForm(): BelongsTo
    {
        return $this->belongsTo(ContactForm::class);
    }

    /**
     * Get the user that created the observation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status text.
     */
    public function getStatusTextAttribute(): ?string
    {
        if (!$this->status) {
            return null;
        }
        
        return \App\Enums\ContactFormStatus::label($this->status);
    }
}
