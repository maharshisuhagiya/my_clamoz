<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxSummary extends Model
{
    protected $fillable = [
        'user_id',
        'summary_text',
        'file_path'
    ];
}