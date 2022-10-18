<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Completed;
use App\Models\User;

class RevisionSubmitAlertAction
{
    public function execute(Completed $completed,User $currentUser){

        $message = 'The refunded Order #'.$completed->order->id.' has been completed and submited by '.$completed->user->name;

         $updateData = [
            'sender'=>$currentUser->id,
            'reciever'=>$completed->order->user->id,
            'message'=>$message,
            'model'=>'Revision',
         ];
         SendAlert::dispatch($updateData);
    }
}
