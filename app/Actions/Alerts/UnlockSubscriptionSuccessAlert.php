<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\User;

class UnlockSubscriptionSuccessAlert
{
    public function execute(User $user,$plan){

        $plan == 1 ? $planType = 'SILVER ONE MONTH PLAN' : ($plan == 2 ? $planType = 'GOLD ONE MONTH PLAN' : ($plan == 3 ? $planType = 'SILVER THREE MONTHS PLAN' : $planType = 'GOLD THREE MONTHS PLAN'));


        $message = 'Hi '.$user->name.', You have successuly subscribed to '.$planType.'. Click unlock section and start earning.';

        $data = [
            'sender'=>$user->id,
            'reciever'=>$user->id,
            'message'=>$message,
            'model'=>'Unlock',
        ];
 
        SendAlert::dispatch($data);
    }
}
