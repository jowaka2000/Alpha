<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class ReportingUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
       $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $header = '';

        if($this->user->user_type==='employer'){
            $header = 'REPORTING AN EMPLOYER';
        }else{
            $header='WRITER A WRITER';
        }

        $user = User::find(auth()->user()->name);

        $message = 'Hello, we have recieved your queries in reporting '.$this->user->name.
        '. We will solve the problem and get back to you shortly. ';

        return $this
        ->markdown('emails.user.report-user',[
            'message'=>$message,
            'header'=>$header,
        ]);
    }
}
