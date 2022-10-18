<?php

namespace App\Mail;

use App\Models\Unlock;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnlockTaskRefund extends Mailable implements ShouldQueue
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

        $assigneUser  = User::find($this->unlock->assigned_user_id);
        $message = 'Hello '.$assigneUser->name.', unlock task #'.$this->unlock->id.
        ' that had been asigned to you has been refunded for revision. It seems the responses you have provided did not meet the reqirements of the person who has posted
        . You are required to check the task again and submit the responses correctly.';

        $instructions = $this->unlock->refund_instructions;
        $user_message = $this->unlock->refund_message;

        return $this
        ->markdown('emails.unlocks.unlock-refund',[
            'message'=>$message,
            'instructions'=>$instructions,
            'user_message'=>$user_message,
            'url'=>route('unlocks.refund')
        ]);
    }
}
