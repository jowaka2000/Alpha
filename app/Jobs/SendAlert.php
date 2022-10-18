<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Alert;

class SendAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sender = $this->data['sender'];
        $reciever = $this->data['reciever'];
        $message = $this->data['message'];
        $model = $this->data['model'];

        Alert::create([
            'user_id'=>$sender,
            'reciever_id'=>$reciever,
            'message'=>$message,
            'model'=>$model,
        ]);
    }
}
