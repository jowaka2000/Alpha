<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\User;

class ReportSendAlertAction
{
    public function execute(User $currentUser,User $user,$data){

        $sender = $currentUser->id;
        $reciever = $currentUser->id;
        $message = 'You have reported '.$user->name.' for \''.$data->problem.'\'. We will contact you as soon as possible after we look at your queries';

        $reportData = [
            'sender'=>$sender,
            'reciever'=>$reciever,
            'message'=>$message,
            'model'=>'User'
        ];

        SendAlert::dispatch($reportData); //sending notification
    }
}
