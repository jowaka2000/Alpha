<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Completed;
use App\Models\User;

class ApproveOrderAlertAction
{
    public function execute(Completed $completed,User $currentUser){
        $alertMessage = 'The order #'.$completed->order->id.' that you submited has been approved!';
        $dataAlert =[
            'sender'=>auth()->user()->id,
            'reciever'=>$completed->user->id,
            'message'=>$alertMessage,
            'model'=>'Completed',
        ];
        SendAlert::dispatch($dataAlert); //sending alert
    }
}
