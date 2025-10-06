<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'ticket_number',
        'subject',
        'description',
        'category_id',
        'priority',
        'status',
        'user_id',
        'assigned_agent_id',
        'assigned_team_id',
        'due_date',
        'resolution_date',
        'satisfaction_rating',
        'satisfaction_comment',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'resolution_date' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_agent_id');
    }

    public function assignedTeam()
    {
        return $this->belongsTo(Team::class, 'assigned_team_id');
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }
}
