<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnlockSubscriptionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data= $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $message = $this->data['message'];
        $user = $this->data['user'];
        $url = route('helpcenter.index',$user);

        return $this
        ->markdown('emails.subscription.unlock-subscription',[
            'message'=>$message,
            'url'=>$url,
        ]);
    }
}
