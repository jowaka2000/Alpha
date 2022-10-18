<?php

namespace App\Actions\Store;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StoreOrderAction
{
    public function execute(User $user, Request $request){

       $order = $user->orders()->create([
            'assignment_type'=>$request->assignment_type,
            'subject'=>$request->subject,
            'service'=>$request->service,
            'pages'=>$request->pages,
            'words'=>$request->words,
            'spacing'=>$request->spacing,
            'sources'=>$request->sources,
            'citation'=>$request->citation,
            'deadline'=>$request->deadline,
            'pay_day'=>$request->pay_day,
            'language'=>$request->language,
            'topic'=>$request->topic,
            'order_visibility'=>$request->order_visibility,
            'description'=>$request->input('description'),
            'status'=>'biding',
            'stage'=>1,
            'bids'=>0,
            'price'=>$request->price,
        ]);


        $searchId = $order->id.',,'.now()->diffInMicroseconds().'--'.now()->diffInMicroseconds().'..'.now()->diffInMinutes().'..'.now()->diffInHours();

        $searchId = Crypt::encrypt($searchId);
        $order->update(['search_id'=>$searchId]);
       return $order;
    }
}
