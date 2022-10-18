<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReassigningOrderMail extends Mailable implements ShouldQueue
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

        $message = $this->info['message'];
        $user = $this->info['user'];
        $url = route('user.report');


        if($user==='employer'){
            $buttonMessage ='Report Writer';
        }else{
            $buttonMessage='Report Employer';
        }

        return $this
        ->markdown('emails.assigned.re-assigning-order'.[
            'message'=>$message,
            'url'=>$url,
            'button_message'=>$buttonMessage,
        ]);
    }
}
