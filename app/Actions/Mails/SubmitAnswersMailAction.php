<?php


namespace App\Actions\Mails;

use App\Jobs\SendAlert;
use App\Mail\OrderCompletedMail;
use App\Models\Assigned;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SubmitAnswersMailAction
{
    public function execute(Assigned $assigned,User $currentUser){

        $message = 'Answers for Order #' . $assigned->order->id . ' has been submited by ' . $currentUser->name . '. ';
        $data = [
            'sender' => $currentUser->id,
            'reciever' => $assigned->order->user_id,
            'message' => $message,
            'model' => 'Assigned',
        ];

        SendAlert::dispatch($data); //sending an alert


        $header = 'ORDER #' . $assigned->order->id . ' HAS BEEN COMPLETED!';
        $emailMessage = 'Hello ' . $assigned->order->user->name . ', the answers for the order #' . $assigned->order->id . ' has been submited by #' . $assigned->user->name . '. Click the link below to check the responses.';

        $info = [
            'header' => $header,
            'message' => $emailMessage,
        ];

        Mail::to($assigned->order->user->email)->send(new OrderCompletedMail($info)); //sending email

    }
}
