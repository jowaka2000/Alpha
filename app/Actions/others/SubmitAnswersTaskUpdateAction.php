<?php

namespace App\Actions\Others;

use App\Models\Assigned;
use App\Models\User;

class SubmitAnswersTaskUpdateAction
{
    public function execute(User $writer,Assigned $assigned){

        $myOrders = $writer->orders;
        $myOrders = $myOrders+1;
        $writer->update(['orders'=>$myOrders]);//updating orders

        $assigned->order->update(['stage' => 3, 'status' => 'pending']);
    }
}
