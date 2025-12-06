<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'gender',
        'relationship',
        'tax_id_type',
        'occupation',
        'visa_type',
        'first_port_entry_date',
        'days_2025',
        'days_2024',
        'days_2023',
    ];
}
