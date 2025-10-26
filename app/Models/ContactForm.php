<?php

namespace App\Models;

use App\Enums\ContactFormLanguage;
use App\Enums\ContactFormStatus;
use App\Enums\ContactFormSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'process_number',
        'name',
        'company',
        'email',
        'phone',
        'subject',
        'custom_subject',
        'message',
        'preferred_language',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'subject' => ContactFormSubject::class,
            'preferred_language' => ContactFormLanguage::class,
            'status' => ContactFormStatus::class,
        ];
    }

    /**
     * Get the observations for the contact form.
     */
    public function observations(): HasMany
    {
        return $this->hasMany(ContactFormObservation::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get the full subject text (including custom subject if applicable).
     */
    public function getFullSubjectAttribute(): string
    {
        if ($this->subject === ContactFormSubject::OTHER && $this->custom_subject) {
            return $this->custom_subject;
        }
        
        return \App\Enums\ContactFormSubject::label($this->subject);
    }

    /**
     * Generate a unique process number.
     */
    public static function generateProcessNumber(ContactFormLanguage $language): string
    {
        do {
            $number = strtoupper($language->value) . str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (self::where('process_number', $number)->exists());
        
        return $number;
    }
}
