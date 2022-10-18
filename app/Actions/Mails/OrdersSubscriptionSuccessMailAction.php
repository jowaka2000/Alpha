<?php

namespace App\Actions\Mails;

use App\Mail\PlatformSubscriptionMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class OrdersSubscriptionSuccessMailAction
{
    public function execute(int $plan,User $user){
        if($plan == 1){
            $myPlan = 'Subcribed to Order\'s one month plan ';

        }else if($plan == 2){
            $myPlan = 'Subcribed to Order\'s three months plan ';

        }else if($plan==3){
            $myPlan = 'Renewed to Order\'s one month plan ';

        }else{
            $myPlan = 'Renewed to Order\'s three month plan ';
        }


        $header = 'SUBCRIPTION PROCESS COMPLETED SUCCESSFULLY!';

        $message = 'Cogratulations '.$user->name.', you have successfuly '.$myPlan.'. You can now enjoy our services for this duration of time
        . If you have any question or concern, reach out the support team and we will respond as soon as posible.';

        $data = [
            'header'=>$header,
            'message'=>$message,
            'user'=>$user,
        ];

        Mail::to($user->email)->send(new PlatformSubscriptionMail($data));
    }
}
