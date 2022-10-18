<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class UnlockTaskRefundUpdate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $unlock;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($unlock)
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
        $files =  $this->unlock->unlockAnswersFiles()->count();
        $assignedUser = User::find($this->unlock->assigned_user_id)->name;

        if ($files === 0) {
            // send unlock answers

            $message = 'Hello ' . $this->unlock->user->name . ', answers for your  refunded task #' . $this->unlock->id . ' has been updated and submited by ' . $assignedUser . '. Here are the new responces;';
            $responses = $this->unlock->answers;
            $completed_link = $this->unlock->completed_link;

            return $this
                ->markdown('emails.unlocks.send-email-with-no-files', [
                    'url' => route('unlocks.completed'),
                    'message' => $message,
                    'responces'=>$responses,
                    'link'=>$completed_link,
                ]);

        } else if ($files === 1) {
            // send that one file

            $file = $this->unlock->unlockAnswersFiles()->first();

            $message = 'Hello ' . $this->unlock->user->name . ', answers for your redunded task #' . $this->unlock->id . ' has been updated and submited by ' . $assignedUser . '. There is one file attached below. Here are the new  responces;';
            $responses = $this->unlock->answers;
            $completed_link = $this->unlock->completed_link;

             return $this
            ->attachFromStorage('unlocks/'.$file->file_name)
                ->markdown('emails.unlocks.send-email-with-one-file', [
                    'url' => route('unlocks.completed'),
                    'message' => $message,
                    'responces'=>$responses,
                    'link'=>$completed_link,
                ]);
        } else {
            $message = 'Hello ' . $this->unlock->user->name . ', answers for your refunded task #' . $this->unlock->id . ' has been updated and submited by ' . $assignedUser.'.';
            return $this
                ->markdown('emails.unlocks.send-answers-with-multiple-files', [
                    'url' => route('unlocks.completed'),
                    'message' => $message,
                ]);
        }

    }
}
