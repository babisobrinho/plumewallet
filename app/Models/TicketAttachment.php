<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    protected $fillable = [
        'ticket_id',
        'message_id',
        'filename',
        'original_name',
        'path',
        'mime_type',
        'size',
        'uploaded_by',
    ];

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function message()
    {
        return $this->belongsTo(TicketMessage::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
