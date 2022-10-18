<?php

namespace App\Actions\Others;

use App\Models\Referral;
use App\Models\User;

class CalculateRefferalAmountAction
{
    public function execute(User $user){

        $myRefferals = Referral::where('reffered_by',$user->refferal_code)->where('paid',false)->get();

        $amont = 0.0;

        if(count($myRefferals)>0){
            foreach($myRefferals as $referal){
                $amont = $amont + $referal->amount;
            }
        }
        return $amont;
    }
}
