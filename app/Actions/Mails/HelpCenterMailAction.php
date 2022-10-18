<?php

namespace App\Actions\Mails;

use App\Jobs\SendAlert;
use App\Mail\HelpCenterMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class HelpCenterMailAction
{
    public function execute(User $user){
        $message1 = 'Your queries has been recieved. We will respond to you shorltly.';

        $data = [
            'sender'=>$user->id,
            'reciever'=>$user->id,
            'message'=>$message1,
            'model'=>'Help',
        ];

        SendAlert::dispatch($data);//sending alert

        $message = 'Hello '.$user->name.', we have recieved your queries successfuly. The support team will solve the issue as soon as possible.';

        $data = [
            'message'=>$message,
        ];

        //uncomment this
       // Mail::to($user->email)->send(new HelpCenterMail($data));

    }
}
