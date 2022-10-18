<?php

namespace App\Mail\Subscriptions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnlocksSubscriptionFailMail extends Mailable implements ShouldQueue
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
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $header = $this->data['header'];
        $message = $this->data['message'];
        $user = $this->data['user'];
        $url = route('helpcenter.index',$user);

        return $this
        ->markdown('emails.subscription.unlocks-subscription-fail',[
            'header'=>$header,
            'message'=>$message,
            'url'=>$url,
        ]);
    }
}
