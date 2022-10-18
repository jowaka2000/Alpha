<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\User;

class UnlocksSubscriptionFailedAlertAction
{
    public function execute($plan,User $user){
        $plan == 1 ? $planType = 'SILVER ONE MONTH PLAN' : ($plan == 2 ? $planType = 'GOLD ONE MONTH PLAN' : ($plan == 3 ? $planType = 'SILVER THREE MONTHS PLAN' : $planType = 'GOLD THREE MONTHS PLAN'));


        $message = 'Hi '.$user->name.', your subscription to '.$planType.' has failed. Try again or get help from help center. Thank you';

        $data = [
            'sender'=>$user->id,
            'reciever'=>$user->id,
            'message'=>$message,
            'model'=>'Unlock',
        ];

        SendAlert::dispatch($data);
    }
}
