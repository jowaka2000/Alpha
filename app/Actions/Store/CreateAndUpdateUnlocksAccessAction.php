<?php

namespace App\Actions\Store;

use App\Models\Access;
use App\Models\User;

class CreateAndUpdateUnlocksAccessAction
{
    public function execute(int $plan,User $user){

        $plan == 1 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMinutes(4) : ($plan==2 ? $time=(now()->tz('Africa/Addis_Ababa'))->addMinutes(4) : ($plan==3 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMinutes(4) : $time=(now()->tz('Africa/Addis_Ababa'))->addMinutes(4)));

        if(env('ENVIRONMENT')!='dev'){
            $plan == 1 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMonth() : ($plan==2 ? $time=(now()->tz('Africa/Addis_Ababa'))->addMonth() : ($plan==3 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMonths(3) : $time=(now()->tz('Africa/Addis_Ababa'))->addMonths(3)));
        }

        $timeToRenew = $time;

        $access = Access::where('user_id',$user->id)->first();

        if($access==null){
            //create new Access

            $user->access()->create([
                'unlocks_subscribed'=>true,
                'unlocks_subscription_end'=>$timeToRenew,
                'unlocks_plan'=>$plan,
                'unlock_subscription_expired'=>false,
                'unlocks_notified'=>false,
            ]);

        }


        if($access!=null){
            //update the access
            $user->access()->update([
                'unlocks_subscribed'=>true,
                'unlocks_subscription_end'=>$timeToRenew,
                'unlocks_plan'=>$plan,
                'unlock_subscription_expired'=>false,
                'unlocks_notified'=>false,
            ]);

        }
    }
}
