<?php

namespace App\Actions;

use App\Models\Completed;
use Illuminate\Http\Request;
use App\Models\Revise;


class StoreRefundAction
{
    public function execute(Request $request,Completed $completed){
        Revise::create([
            'order_id'=>$completed->order->id,
            'user_id'=>$completed->user_id,
            'instruction'=>$request->instruction,
        ]);

        $completed->order->update(['status'=>'revised']);
        $completed->update(['status'=>'revised']);
    }
}
