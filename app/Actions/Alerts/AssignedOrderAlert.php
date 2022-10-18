<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Bid;
use App\Models\User;

class AssignedOrderAlert
{
    public function execute(User $user,Bid $bid){
        $sender = $user->id;
        $message = 'You have been assigned order #' . $bid->order->id . '. You are required to complete it within the time given';
        $reciever = $bid->user->id;

        $data = [
            'sender' => $sender,
            'reciever' => $reciever,
            'message' => $message,
            'model' => 'Bid',
        ];
        SendAlert::dispatch($data); //send notification
    }
}
