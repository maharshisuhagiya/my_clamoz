<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherExpenseEntry extends Model
{
    protected $fillable = [
        'user_id',
        'question_no',
        'yes_no',
        'text'
    ];
}
