<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\User;

class OrdersSubscriptionSuccessAlert
{
    public function execute($plan,User $user){

        $plan == 1 ? $planType = 'Subscribed to ONE MONTH PLAN' : ($plan == 2 ? $planType = 'Subscribed to THREE MONTH PLAN' : ($plan == 3 ? $planType = 'Renewed to ONE MONTH PLAN' : $planType = 'Renewed to ONE MONTH PLAN'));


        $message = 'Hi '.$user->name.', You have successfuly Order Task\'s '.$planType.'. You can now bid unlimited orders from the platform. Thank you';

        $data = [
            'sender'=>$user->id,
            'reciever'=>$user->id,
            'message'=>$message,
            'model'=>'Unlock',
        ];
        SendAlert::dispatch($data);
    }
}
