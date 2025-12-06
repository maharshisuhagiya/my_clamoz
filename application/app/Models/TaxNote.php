<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxNote extends Model
{
    protected $fillable = [
        'user_id','date','time','zone','query'
    ];
}
