<?php

namespace  App\Actions\Mails;

use App\Mail\OrderCompletedMail;
use App\Models\Completed;
use Illuminate\Support\Facades\Mail;

class SubmitRevisionMailAction
{
    public function execute(Completed $completed){
        $header = 'ORDER #' . $completed->order->id . ' HAS BEEN COMPLETED!';
        $emailMessage = 'Hello ' . $completed->order->user->name . ', the answers for the order #' . $completed->order->id . ' that you had refunded for revision has been submited by #' . $completed->user->name . '. Click the link below to check the responses.';

        $info = [
            'header' => $header,
            'message' => $emailMessage,
        ];


        Mail::to($completed->order->user->email)->send(new OrderCompletedMail($info));
    }
}
