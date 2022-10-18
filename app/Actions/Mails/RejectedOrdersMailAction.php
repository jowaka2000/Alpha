<?php

namespace App\Actions\Mails;

use App\Mail\OrderRejectedMail;
use App\Models\Completed;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RejectedOrdersMailAction
{
    public function execute(Completed $completed,User $currentUser){

        $header = 'YOUR ORDER HAS BEEN REJECTED BY EMPLOYER!';
        $meailMessage = 'Hello '.$completed->user->name.', the order #'.$completed->order->id.' that you had been assigned has been rejected by your employer.
         it looks like your employer was not satisfied by the responses you provided. If there is no valid reasion why the emoloyer rejected this task, please report
         immedietly in Alpha Bailwake platform and we will respond to your queries as soon as possible. You can click the buttom below.';

         $employer = $completed->order->user;
         $dataEmail1 = [
            'header'=>$header,
            'message'=>$meailMessage,
            'employer'=>$employer
         ];

        Mail::to($completed->user->email)->send(new OrderRejectedMail($dataEmail1)); //mail to writer

        $header2 = 'YOU HAVE REJECTED AN ORDER!';
        $meailMessage2 = 'Hello '.$currentUser->name.', we have identified that you have rejected #'.$completed->order->id.' that you had assigned '.$completed->user->name.'.
         If the writer has not followed or terms and conditions, we advise you to report immedietly through the report center or send us an email and we will respond to your queries immedietly. You can click the buttom below.';

         $writer = $completed->user;


         $dataEmail1 = [
            'header'=>$header2,
            'message'=>$meailMessage2,
            'employer'=>$writer
         ];


        Mail::to($currentUser->email)->send(new OrderRejectedMail($dataEmail1)); //mail to writer

    }
}
