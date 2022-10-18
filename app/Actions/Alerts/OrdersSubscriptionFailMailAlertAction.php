<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\User;

class OrdersSubscriptionFailMailAlertAction
{
    public function execute(User $user){

        $message = 'The transactions for your orders scubscription to this platform failed to completed. Try that process again to complete the subscription process.';

        $data = [
            'sender'=>$user->id,
            'reciever'=>$user->id,
            'message'=>$message,
            'model'=>'Order',
        ];

        SendAlert::dispatch($data);
    }

}
