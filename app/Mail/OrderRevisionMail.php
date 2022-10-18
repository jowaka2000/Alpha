<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderRevisionMail extends Mailable implements ShouldQueue
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
        $message  = $this->info['message'];
        $user= $this->info['user'];
        $url1=route('completed.index');
        $url2=route('report.index',$user);
        return $this->markdown('emails.completed.order-revision',[
            'message'=>$message,
            'url1'=>$url1,
            'url2'=>$url2
        ]);
    }
}
