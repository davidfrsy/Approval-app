<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function requestedWorkRequests()
    {
        return $this->hasMany(WorkRequest::class, 'requester_id');
    }

    public function assignedWorkRequests()
    {
        return $this->hasMany(WorkRequest::class, 'assigned_to');
    }

    public function approvedWorkRequests()
    {
        return $this->hasMany(WorkRequest::class, 'approved_by');
    }

    public function requestHistories()
    {
        return $this->hasMany(RequestHistory::class, 'user_id');
    }
}
