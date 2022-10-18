<?php

namespace App\Mail\Subscriptions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnlockSSubscriptionPlanExpiaryMail extends Mailable implements ShouldQueue
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
        $message = $this->data['message'];
        $user = $this->data['user'];
        $url = route('unlocks-subscriprion.index');
        $url1 = route('helpcenter.index',$user);
        return $this
        ->markdown('emails.subscription.unlocks-subscription-time-expiary',[
            'message'=>$message,
            'url'=>$url,
            'url1'=>$url1,
        ]);
    }
}
