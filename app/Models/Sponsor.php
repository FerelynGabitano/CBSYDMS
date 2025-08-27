<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $primaryKey = 'sponsor_id'; // since you’re not using default "id"

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'logo_path',
    ];
}
