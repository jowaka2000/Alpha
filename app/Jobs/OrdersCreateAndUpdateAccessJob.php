<?php

namespace App\Jobs;

use App\Actions\Store\OrdersCreateAndUpdateAccessAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrdersCreateAndUpdateAccessJob implements ShouldQueue
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
        $this->data=$data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(OrdersCreateAndUpdateAccessAction $ordersCreateAndUpdateAccessAction)
    {
        $plan = $this->data['plan'];
        $user = $this->data['user'];

        $ordersCreateAndUpdateAccessAction->execute($user,$plan);
    }
}
