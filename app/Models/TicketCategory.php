<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
        'sla_hours',
        'assigned_team_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function assignedTeam()
    {
        return $this->belongsTo(Team::class, 'assigned_team_id');
    }

    public function tickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
