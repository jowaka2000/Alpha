<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCompletedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info=$info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $header = $this->info['header'];
        $message = $this->info['message'];
        $url = route('completed.index');

        return $this
        ->markdown('emails.assigned.order-completed',[
            'header'=>$header,
            'message'=>$message,
            'url'=>$url,
        ]);
    }
}
