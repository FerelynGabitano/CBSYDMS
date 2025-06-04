<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sponsor extends Model
{
    protected $primaryKey = 'sponsor_id';

    public function contributions(): HasMany
    {
        return $this->hasMany(SponsorContribution::class, 'sponsor_id');
    }
}