<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\User;

class UnsubscribeOrdersUserAlertAction
{
    public function execute(User $user)
    {
        $message1 = 'Hello ' . $user->name . ' your platform subscription for taking task orders has ended. Renew your subscription for the next months and enjoy best services agin.';
        $data = [
            'sender' => $user->id,
            'reciever' => $user->id,
            'message' => $message1,
            'model' => 'Subscription',
        ];

        SendAlert::dispatch($data); //sending notification
    }
}
