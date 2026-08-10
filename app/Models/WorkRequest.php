<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkRequest extends Model
{
    protected $fillable = [
        'requester_id',
        'assigned_to',
        'approved_by',
        'status',
        'submitted_at',
        'approved_at',
        'started_at',
        'completed_at',
        'title',
        'description',
        'priority',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'approved_at' => 'datetime',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function histories()
    {
        return $this->hasMany(RequestHistory::class, 'work_request_id');
    }
}
