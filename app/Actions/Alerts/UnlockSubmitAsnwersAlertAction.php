<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Unlock;
use App\Models\User;

class UnlockSubmitAsnwersAlertAction
{
    public function execute(Unlock $unlock,User $user){
        $message = 'Unlock task #' . $unlock->id . ' has been completed and submited by ' . $user->name;
        $data = [
            'sender' => $user->id,
            'reciever' => $unlock->user->id,
            'message' => $message,
            'model' => 'Unlock'
        ];
        SendAlert::dispatch($data);
    }
}
