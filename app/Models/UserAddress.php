<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_addresses';
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'user_id', 'street_address', 'barangay', 'city_municipality', 'province', 'zip_code'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
