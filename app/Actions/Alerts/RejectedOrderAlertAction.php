<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Completed;
use App\Models\User;

class RejectedOrderAlertAction
{
    public function execute(Completed $completed,User $currentUser){

        $message = 'Order #'.$completed->order->id.' has been rejected by the your employer!';
        $dataAlert = [
            'sender'=>$currentUser->id,
            'reciever'=>$completed->user->id,
            'message'=>$message,
            'model'=>'Completed',
        ];

        SendAlert::dispatch($dataAlert);//send alert

    }
}
