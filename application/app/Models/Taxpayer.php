<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxpayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'middle_name', 'last_name',
        'ssn_itin', 'occupation',
        'dob', 'gender',
        'email', 'mobile', 'alt_mobile',
        'street', 'city', 'state', 'country', 'country_of_citizenship', 'zip', 'first_port_entry_date',
        'visa_type', 'current_employer', 'filing_status'
    ];
}
