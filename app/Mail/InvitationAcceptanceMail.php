<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationAcceptanceMail extends Mailable implements ShouldQueue
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
        $this->info = $info;
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


        return $this
        ->markdown('emails.invitations.invitation-acceptance',[
            'header'=>$header,
            'message'=>$message,
            'url'=>route('orders.index')
        ]);
    }
}
