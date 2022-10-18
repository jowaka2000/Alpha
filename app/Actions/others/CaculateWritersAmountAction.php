<?php

namespace App\Actions\Others;

use App\Models\Earning;
use App\Models\User;

class CaculateWritersAmountAction
{
    public function execute(User $currentUser){
        $earnings = Earning::where('status','unpayed')->where('employer_order_id',$currentUser->id)->get();

        $totalAmount=0.00;
        foreach($earnings as $earning){
            $totalAmount = $totalAmount+$earning->amount;
        }

        $writers =  User::allWritersToPay();
        $writersAndAmount=[];


        foreach($writers as $writer){
            $writerEarnings = Earning::where('status','unpayed')->where('user_id',$writer->id)->get();

            $amount = 0.00;
            foreach($writerEarnings as $earning){
                $amount=$amount+$earning->amount;
            }
            $writersAndAmount[$writer->id]=$amount;
            $writersAndAmount[$writer->id.' orders']= count($writerEarnings);
        }

        $writersAndAmount['total_amount']=$totalAmount;

        return json_encode($writersAndAmount);
    }
}
