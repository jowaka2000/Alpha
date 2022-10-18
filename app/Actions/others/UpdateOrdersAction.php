<?php

namespace App\Actions\Others;

use App\Models\Completed;
use App\Models\User;

class updateOrdersAction
{ 
    public function execute(Completed $completed,string $status){
        $writer = User::find($completed->user_id);

        $orders = $writer->orders;
        $refunds = $writer->refunds;
        $rejected = $writer->rejected;


        if($status==='revision'){
            $refunds = $refunds+1;
            $rating = $this->calculatingRatings($orders,$refunds,$rejected);
            $writer->update([
                'refunds'=>$refunds,
                'success_rate'=>$rating,
            ]);

        }else if($status==='reject'){
            $rejected = $rejected+1;
            $rating = $this->calculatingRatings($orders,$refunds,$rejected);
            $writer->update([
                'rejected'=>$rejected,
                'success_rate'=>$rating,
            ]);

        }else{
            $rating = $this->calculatingRatings($orders,$refunds,$rejected);
            $writer->update([
                'success_rate'=>$rating,
            ]);
        }
    }

    private function calculatingRatings($orders, $refunds, $rejected){

        $re= $refunds;
        $rj = $rejected;
        if($refunds===null){
            $re = 0;
        }

        if($rejected===null){
            $rj = 0;
        }

        $total = $re+$rj;

        $fail = ($total/$orders)*100;

        $ratings = 100-$fail;

        if($ratings<0){
            $ratings=0;
        }

        return $ratings;
    }
}
