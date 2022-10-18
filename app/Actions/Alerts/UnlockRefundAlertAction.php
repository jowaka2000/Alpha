<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Unlock;
use App\Models\User;

class UnlockRefundAlertAction
{
    public function execute(Unlock $unlock,User $user,User $assigneUserPerson){
        $message1 = 'Unlock task #' . $unlock->id . ' has been refunded for revision. Please check it and submit correct responses as soon as posible.';
        $message2 = 'You have refunded unlock task #' . $unlock->id . ' for revision. We are sorry for what happen. Your task will be completed and submited as soon as possible';
        $data1 = [
            'sender' => $user->id,
            'reciever' => $assigneUserPerson->id,
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
        SendAlert::dispatch($data2); //sending notifications
    }
}
