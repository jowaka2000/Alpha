<?php

namespace App\Mail;

use App\Models\Unlock;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignedUnlockTask extends Mailable implements ShouldQueue
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
        $message = 'Hello '.$assignedUser->name.', you have been assigned unlock task #'.$this->unlock->id.
        '. You should complete and submit it within 10 minutes.';

        return $this
        ->markdown('emails.unlocks.assign-unlock-task',[
            'message'=>$message,
        ]);
    }
}
