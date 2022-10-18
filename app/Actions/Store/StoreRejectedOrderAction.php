<?php

namespace App\Actions\Store;

use App\Models\Completed;
use App\Models\Rejected;

class StoreRejectedOrderAction
{
    public function execute(Completed $completed){
        Rejected::create([
            'user_id'=>$completed->user_id,
            'order_id'=>$completed->order->id,
            'owner_id'=>$completed->order->user_id,
            'topic'=>$completed->order->topic,
        ]);
    }
}
