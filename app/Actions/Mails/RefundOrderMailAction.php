<?php

namespace App\Actions\Mails;

use App\Jobs\SendAlert;
use App\Mail\OrderRevisionMail;
use App\Models\Completed;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RefundOrderMailAction
{


    public function execute(Completed $completed,User $currentUser){
        $message1 = 'Order #'.$completed->order->id.' has been refunded for revision. Review the task and complete it within the time given';
        $data1 =[
            'sender'=>$currentUser->id,
            'reciever'=>$completed->user_id,
            'message'=>$message1,
            'model'=>'Completed',
        ];

        SendAlert::dispatch($data1);

        $message2 = 'You have refunded Order #'.$completed->order->id.' for revision. We have notified assigned writer to complete the task within the time given.';

        $data2 =[
            'sender'=>$currentUser->id,
            'reciever'=>$currentUser->id,
            'message'=>$message2,
            'model'=>'Completed',
        ];

        SendAlert::dispatch($data2);//sending alerts

        $info = [
            'message'=>'Hello '.$completed->user->name.', Order #'.$completed->order->id.' has been forwaded for revision. It seems the employer was not contented with your response.
            Re-check your responces and submit the answers within the time given.',
            'user'=>$currentUser,
        ];
        Mail::to($completed->user->email)->send(new OrderRevisionMail($info));//sending email
    }
}
