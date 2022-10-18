<?php

namespace App\Actions\Mails;

use App\Mail\UnlockSubscriptionMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UnlockSubscriptionSuccessMailAction
{
    public function execute(User $user,$plan){

        $plan == 1 ? $planType = 'SILVER ONE MONTH PLAN' : ($plan == 2 ? $planType = 'GOLD ONE MONTH PLAN' : ($plan == 3 ? $planType = 'SILVER THREE MONTHS PLAN' : $planType = 'GOLD THREE MONTHS PLAN'));


        $message = 'Hi '.$user->name.', you have successfuly subscribe to '.$planType.'. You can now click unlock section and start earning immedietly for this duration of time.
         Remember to submit any allocated unlock task in less than 15 minutes accornding to platform policy. You are also required to follow every instruction given by the unlock task\'s owners.
         In addition, all policies of this platform concerning unclocks must be followed.';

         $data = [
            'message'=>$message,
            'user'=>$user,
         ];

         Mail::to($user->email)->send(new UnlockSubscriptionMail($data));
    }
}
