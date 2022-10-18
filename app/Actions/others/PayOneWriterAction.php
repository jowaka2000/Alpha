<?php

namespace App\Actions\Others;

use App\Models\Completed;
use App\Models\Earning;
use App\Models\User;

class  PayOneWriterAction
{
    public function execute(User $writer,User $employer){

        $earnings = Earning::where('user_id',$writer->id)->where('status','unpayed')->where('employer_order_id',$employer->id)->get();
        $completed = Completed::where('status','completed')->where('paid',false)->where('user_id',$writer->id)->where('employer_id',$employer->id)->get();


        foreach($earnings as $earning){
            $earning->update(['status'=>'payed']);
        }

        foreach($completed as $completed){
            $completed->update(['paid'=>true]);
            $completed->order->update(['paid'=>true]);
        }
    }
}
