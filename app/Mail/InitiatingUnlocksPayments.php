<?php

namespace App\Mail;

use App\Models\Unlock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InitiatingUnlocksPayments extends Mailable implements ShouldQueue
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
        $message = 'You have innitiated payments for unlock task #'.$this->unlock->id.'. Complete the payments and get the answers in less than 10 minutes.';
        return $this
        ->markdown('emails.unlocks.initiate-unlock-payments',[
            'message'=>$message,
        ]);
    }
}
