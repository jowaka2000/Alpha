<?php

namespace App\Actions\Mails;

use App\Jobs\SendAlert;
use App\Mail\ReassigningOrderMail;
use App\Models\Assigned;
use Illuminate\Support\Facades\Mail;

class ReasigningOrderMailAction
{
    public function execute(Assigned $assigned){

        $message1 = 'Order #' . $assigned->order->id . ' has been re-assigned by the employer!';

        $data1 = [
            'sender' => $assigned->order->user_id,
            'reciever' => $assigned->user->id,
            'message' => $message1,
            'model' => 'Assigned',
        ];

        SendAlert::dispatch($data1); //sending alert to writer

        $message2 = 'You have partially re-assigned Order #' . $assigned->order->id . '.  Headover to active orders and fully re-assign the order to the disired writer';

        $data2 = [
            'sender' => $assigned->order->user_id,
            'reciever' => $assigned->order->user_id,
            'message' => $message2,
            'model' => 'Assigned',
        ];
        SendAlert::dispatch($data2); //sending alert to employer

        $message1 = 'We have discovered that you have re-assigned order #' . $assigned->order->id . '. which had been assigned to ' . $assigned->user->name .
            '. If the writer has violated any platform policy, you can take a step to report this writer.';

        $info1 = [
            'message' => $message1,
            'user' => 'employer'
        ];

        Mail::to($assigned->order->user->email)->send(new ReassigningOrderMail($info1));  //sending mail to employer
        $message2 = 'Hello ' . $assigned->user->id . ', we have discovered that the order #' . $assigned->order->id . ' that you had been assigned has been re-assigned by the employer.
         If the employer has violated any platform policy, you can take a step to report this employer';

        $info2 = [
            'message' => $message2,
            'user' => 'writer'
        ];

        Mail::to($assigned->user->email)->send(new ReassigningOrderMail($info2)); //sending mail to writer

    }
}
