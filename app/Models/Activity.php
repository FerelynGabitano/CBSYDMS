<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use Carbon\Carbon;

class Activity extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'activity_id';

    protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'location',
        'max_participants',
        'created_by',
        'lead_facilitator_id',
        'is_active',
    ];

    // Accessors
    public function getStartDateAttribute()
    {
        return $this->start_datetime ? Carbon::parse($this->start_datetime) : null;
    }

    public function getEndDateAttribute()
    {
        return $this->end_datetime ? Carbon::parse($this->end_datetime) : null;
    }

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function leadFacilitator()
    {
        return $this->belongsTo(User::class, 'lead_facilitator_id');
    }

    // ✅ Participants (members who joined)
    public function participants()
{
    return $this->belongsToMany(User::class, 'activity_participants', 'activity_id', 'user_id')
        ->using(\App\Models\ActivityParticipant::class)
        ->withPivot('participant_id', 'attendance_status')
        ->withTimestamps();
}


}
