<?php

namespace App\Actions\Others;

use App\Models\Answer;
use App\Models\Bid;
use App\Models\Completed;

class RejectedOrderUpdatesAction
{
    public function execute(Completed $completed){
        $completed->update(['status'=>'rejected']);
        $completed->order->update(['status'=>'biding','stage'=>'rejected']);

        
        $bids = Bid::where('order_id',$completed->order->id)->get();

        foreach($bids as $bid){
            $bid->update(['stage'=>1]);
        }

        $completed->assigned->delete();

        $answers = Answer::where('order_id',$completed->order->id)->get();

        foreach($answers as $answer){
            $answer->delete();
        }

    }
}
