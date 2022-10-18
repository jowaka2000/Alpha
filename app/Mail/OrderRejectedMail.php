<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderRejectedMail extends Mailable implements ShouldQueue
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
        $this->data=$data;
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
        $employer = $this->data['employer'];
        $url = route('user.report',$employer);

        return $this
        ->markdown('emails.rejected.rejected-order',[
            'header'=>$header,
            'message'=>$message,
            'url'=>$url,
        ]);
    }
}
