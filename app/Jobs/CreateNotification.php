<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $message;
    public $reciever_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$message,$reciever_id)
    {
        $this->user= $user;
        $this->message=$message;
        $this->reciever_id = $reciever_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notices()->create([
            'reciever_id'=>$this->id,
            'message'=>$this->message,
        ]);
    }
}
