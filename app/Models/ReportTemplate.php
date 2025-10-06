<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'data_source',
        'filters',
        'columns',
        'chart_type',
        'is_public',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'filters' => 'array',
        'columns' => 'array',
        'is_public' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function savedReports()
    {
        return $this->hasMany(SavedReport::class, 'template_id');
    }

    public function schedules()
    {
        return $this->hasMany(ReportSchedule::class);
    }
}
