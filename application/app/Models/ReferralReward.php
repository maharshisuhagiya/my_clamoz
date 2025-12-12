<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralReward extends Model
{
    protected $fillable = [
        'user_id', 'reward_value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
