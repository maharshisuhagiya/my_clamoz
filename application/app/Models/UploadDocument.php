<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadDocument extends Model
{
    protected $fillable = [
        'user_id',
        'doc_type',
        'file_path',
    ];
}
