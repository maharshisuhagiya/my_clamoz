<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ReferralReward;

class ReferralController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $userId = $user->id;

        // Total reward points for logged in user
        $totalRewardPoints = ReferralReward::where('user_id', $userId)->sum('reward_value');

        // List of users he referred
        $referredUsers = User::where('referred_by', $userId)->get();

        // Reward for each referred user = latest reward record
        foreach ($referredUsers as $u) {
            $u->earned_reward = ReferralReward::where('user_id', $userId)->first()->reward_value ?? 0;
        }

        return view(
            'pages.referral.index',
            compact('totalRewardPoints', 'referredUsers')
        );
    }
}
