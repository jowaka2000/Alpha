<?php

namespace App\Actions\Alerts;

use App\Jobs\SendAlert;
use App\Models\Access;

class UnsubscribeUnlocksSubscribersAlertAction
{
    public function execute(Access $access){
        $message = 'Your Unlocks subscription plan has expired. Navigate to Unlocks section and subscribe agin. Thank you!';

        $data =[
            'sender'=>$access->user->id,
            'reciever'=>$access->user->id,
            'message'=>$message,
            'model'=>'Unlock'
        ];

        SendAlert::dispatch($data);
    }
}
