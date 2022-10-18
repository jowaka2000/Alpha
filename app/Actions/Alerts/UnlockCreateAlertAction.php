<?php


namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\User;

class UnlockCreateAlertAction
{
    public function execute(User $user){
        $message = 'You have successfuly added task unlock, complete the payment to get answers instantly.';

        $data = [
            'sender'=>$user->id,
            'reciever'=>$user->id,
            'message'=>$message,
            'model'=>'Unlock'
        ];
        SendAlert::dispatch($data);
    }
}
