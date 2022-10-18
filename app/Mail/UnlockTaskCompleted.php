<?php

namespace App\Mail;

use App\Models\Unlock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UnlockTaskCompleted extends Mailable implements ShouldQueue
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
        $files =  $this->unlock->unlockAnswersFiles()->count();
        $assignedUser = User::find($this->unlock->assigned_user_id)->name;

        if ($files === 0) {
            // send unlock answers

            $message = 'Hello ' . $this->unlock->user->name . ', answers for your task #' . $this->unlock->id . ' has been completed and submited by ' . $assignedUser . '. Here is  are the responces;';
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

            $message = 'Hello ' . $this->unlock->user->name . ', answers for your task #' . $this->unlock->id . ' has been completed and submited by ' . $assignedUser . '. We have attached a answers file below. Here is  are the responces;';
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
            $message = 'Hello ' . $this->unlock->user->name . ', answers for your task #' . $this->unlock->id . ' has been completed and submited by ' . $assignedUser.'.';
            return $this
                ->markdown('emails.unlocks.send-answers-with-multiple-files', [
                    'url' => route('unlocks.completed'),
                    'message' => $message,
                ]);
        }
    }
}
