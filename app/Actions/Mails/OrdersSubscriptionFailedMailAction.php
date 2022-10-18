<?php

namespace App\Actions\Mails;

use App\Mail\PlatformSubscriptionMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class OrdersSubscriptionFailedMailAction
{
    public function execute(User $user,string $result){

        $header = 'SUBCRIPTION PROCESS FAILED!';

        $message = 'Hello '.$user->name.', the transactions for your orders scubscription to '.env('APP_NAME').' platform failed to completed. The reason for this failing might be \''.$result.
        '\'. Try that process again to complete the subscription process. If you have any difficulty, reach '.env('APP_NAME').' support team and we will respond as soon as possible.';

        $data = [
            'header'=>$header,
            'message'=>$message,
            'user'=>$user,
        ];

        Mail::to($user->email)->send(new PlatformSubscriptionMail($data));
    }
}
