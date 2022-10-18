<?php

namespace App\Actions\Mails;

use App\Mail\SubscriptionEndMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UnsubscribeOrdersUserMailAction
{
    public function execute(User $user){

        $message ='Hello '.$user->name.' your order\'s subscription for taking task orders has ended. Visit '.env('APP_NAME').'platform and renew your subscription for the next months.';

        $data = [
            'message'=>$message,
            'user'=>$user,
        ];

        Mail::to($user->email)->send(new SubscriptionEndMail($data));
    }
}
