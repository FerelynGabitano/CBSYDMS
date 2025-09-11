<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'location',
        'max_participants',
        'created_by',
        'is_active',
    ];

    // Relationship: Activity belongs to a User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

