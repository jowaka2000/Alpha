<?php

namespace App\Actions\Mails;

use App\Mail\Subscriptions\UnlockSSubscriptionPlanExpiaryMail;
use App\Models\Access;
use Illuminate\Support\Facades\Mail;

class UnsubscribeUnocksUserMailAction
{
    public function execute(Access $access){
        $message = 'Hi '.$access->user->name.', you Unlocks subscription plan has expired. To continue earning from '.env('APP_NAME').' platform, visit the website and subscribe agin.
        If you have any queries, reach out our support team through help center.';

        $data  = [
            'message'=>$message,
            'user'=>$access->user,
        ];

        Mail::to($access->user->email)->send(new UnlockSSubscriptionPlanExpiaryMail($data));
    }
}
