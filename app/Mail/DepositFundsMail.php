<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DepositFundsMail extends Mailable
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
        $this->data =$data;
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
        
        if($user!=''){
            $url = route('helpcenter.index',$user);
        }else{
            $url ='';
        }

        return $this
        ->markdown('emails.deposit.deposit-funds-mail',[
            'header'=>$header,
            'message'=>$message,
            'url'=>$url,
        ]);
    }
}
