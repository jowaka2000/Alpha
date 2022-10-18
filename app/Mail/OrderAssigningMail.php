<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderAssigningMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'Hello, you have been assigned Order #' . $this->order->id . ' by ' . $this->order->user->name .
         '. Head over to the website and complete the assignment within the time given. You can click the button below and headover to the assignement section.';
        $url = route('assigned.index');

        return $this
        ->markdown('emails.assigned.order-assigning',[
            'message'=>$message,
            'url'=>$url,
        ]);
    }
}
