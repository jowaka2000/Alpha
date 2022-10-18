<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Unlock;
use App\Models\User;

class UnlockTakeTaskAlertAction
{
    public function execute(Unlock $unlock,User $user){

        $message1 = 'You have been assigned task unlock #' . $unlock->id . '. You are required to complete it within 10 minutes.';
        $message2 = $user->name . ' has been assigned your task for unlock #' . $unlock->id . '. Responses will be ready within 10 minutes.';

        $data1 = [
            'sender' => $user->id,
            'reciever' => $user->id,
            'message' => $message1,
            'model' => 'Unlock'
        ];

        $data2 = [
            'sender' => $user->id,
            'reciever' => $unlock->user->id,
            'message' => $message2,
            'model' => 'Unlock'
        ];

        SendAlert::dispatch($data1);
        SendAlert::dispatch($data2);
    }
}
