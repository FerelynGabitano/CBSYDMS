<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $primaryKey = 'sponsor_id'; 

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
    ];
    public function activities()
{
    return $this->hasMany(Activity::class, 'sponsor_id', 'sponsor_id');
}
}

