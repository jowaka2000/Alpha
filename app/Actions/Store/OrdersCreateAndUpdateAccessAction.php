<?php

namespace App\Actions\Store;
use App\Models\Access;
use App\Models\User;

class OrdersCreateAndUpdateAccessAction
{
    public function execute(User $user,$plan){

        $plan == 1 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMinutes(4) : ($plan==2 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMinutes(4) : ($plan==3 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMinutes(4) : $time = (now()->tz('Africa/Addis_Ababa'))->addMinutes(4)));

        if(env('ENVIRONMENT') != 'dev'){
            $plan == 1 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMonth() : ($plan==2 ? $time =(now()->tz('Africa/Addis_Ababa'))->addMonths(3) : ($plan==3 ? $time = (now()->tz('Africa/Addis_Ababa'))->addMonth() : $time = (now()->tz('Africa/Addis_Ababa'))->addMonths(3)));
        }

        $timeToRenew = $time;

        $access = Access::where('user_id',$user->id)->first();

        if($access==null){
            //create new Access

            $user->access()->create([
                'orders_subscribed'=>true,
                'orders_subscription_end'=>$timeToRenew,
                'orders_plan'=>$plan,
                'order_subscription_expired'=>false,
                'orders_notified'=>false,
            ]);

        }


        if($access!=null){
            //update the access
            $user->access()->update([
                'orders_subscribed'=>true,
                'orders_subscription_end'=>$timeToRenew,
                'orders_plan'=>$plan,
                'order_subscription_expired'=>false,
                'orders_notified'=>false,
            ]);

        }
    }
}
