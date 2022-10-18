<?php

namespace App\Actions\Others;

use App\Models\Order;
use App\Models\Earning;

class CreateEarningsAction
{
    public function execute(Order $order,int $user_id){
        Earning::create([
            'user_id'=>$user_id,
            'order_id'=>$order->id,
            'employer_order_id'=>$order->user->id,
            'status'=>'unpayed',
            'amount'=>$order->price,
        ]);
    }
}
