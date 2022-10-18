<?php

namespace App\Actions\Mails;

use App\Mail\Subscriptions\UnlocksSubscriptionFailMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UnlocksSubscriptionFailedMailAction
{
    public function execute(User $user,$result){
        $header = 'SUBCRIPTION PROCESS FAILED!';

        $message = 'Hello '.$user->name.', the transactions for your unlocks scubscription to Alpha Bailwake failed to completed. The reason for this failing might be \''.$result.
        '\'. Try that process again to complete the subscription process. If you have any difficulty, reach Alpha Bailwake support team and we will respond as soon as possible.';

        $data = [
            'header'=>$header,
            'message'=>$message,
            'user'=>$user,
        ];

        Mail::to($user->email)->send(new UnlocksSubscriptionFailMail($data));
    }
}
