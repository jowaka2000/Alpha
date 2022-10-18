<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Unlock;
use App\Models\User;

class UnlockTaskReporting extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $unlock;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Unlock $unlock)
    {
        $this->unlock=$unlock;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $assignedUser = User::find($this->unlock->assigned_user_id);


        $message = 'Hello '.$assignedUser->name.', your request for reporting unlock task #'.$this->unlock->id.
        ' has been recieved. We will solve the problem and get back to you shortly. ';

        return $this
        ->markdown('emails.unlocks.report-unlock',[
            'message'=>$message,
        ]);
    }
}
