<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'address_of',
        'from_date',
        'to_date',
        'full_address'
    ];
}
