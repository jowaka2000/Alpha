<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Unlock;
use App\Models\User;

class ReportUnlockAlertAction
{
    public function execute(Unlock $unlock,User $user){
        $message = 'You have reported task #' . $unlock->id . '. We will Contact you as soon as possible.';

        $dataAlert = [
            'sender' => $user->id,
            'reciever' => $user->id,
            'message' => $message,
            'model' => 'Unlock'
        ];

        SendAlert::dispatch($dataAlert); //sending notifications
    }
}
