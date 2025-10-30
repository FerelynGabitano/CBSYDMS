<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ActivityParticipant extends Pivot
{
    protected $table = 'activity_participants';
    protected $primaryKey = 'participant_id'; // or remove this if your table doesn’t have a PK column

    protected $fillable = [
        'activity_id',
        'user_id',
        'attendance_status',
    ];
}
