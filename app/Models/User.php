<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'email',
        'password',
        'street_address',
        'barangay',
        'city_municipality',
        'province',
        'zip_code',
        'profile_picture',
        'role_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationships
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(UserRequirement::class, 'user_id');
    }

    public function reviewedRequirements(): HasMany
    {
        return $this->hasMany(UserRequirement::class, 'reviewed_by');
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'activity_participants', 'user_id', 'activity_id')
            ->withPivot('attendance_status', 'registered_at');
    }

    public function createdActivities(): HasMany
    {
        return $this->hasMany(Activity::class, 'created_by');
    }

    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(AttendanceLog::class, 'user_id');
    }

    public function recordedContributions(): HasMany
    {
        return $this->hasMany(SponsorContribution::class, 'recorded_by');
    }
}
