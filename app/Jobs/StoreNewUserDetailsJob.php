<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreNewUserDetailsJob implements ShouldQueue
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
        $code = $this->data['code'];
        $user = $this->data['user'];

        if($code!=null){
            $user->referrals()->create([
                'reffered_by' => $code,
            ]);
        }

        //create Equity
        $data = [
            'time registered'=>now(),
        ];

        $user->equity()->create([
            'wallet'=>0.0,
            'data'=>json_encode($data),
        ]);


        //create access

        $user->access()->create([
            'unlocks_subscribed'=>false,
            'orders_subscribed'=>false,
        ]);

    }
}
