<?php

namespace App\Actions\Store;

use App\Models\Assigned;
use App\Models\Bid;
use Illuminate\Support\Facades\Crypt;

class StoreAssignedAction
{
    public function execute(Bid $bid){

        $assigned = Assigned::create([
            'user_id' => $bid->user_id,
            'order_id' => $bid->order->id,
            'owner_id' => $bid->order->user->id,
            'topic' => $bid->order->topic,
            'stage' => 1
        ]);

        $bid->update(['status' => 'assigned']);

        $bid->order->update([
            'status' => 'assigned',
        ]);


        $search_id= $assigned->id.now()->diffInMilliseconds().',,'.now()->diffInMinutes().',,'.now()->diffInHours();
        $search_id= Crypt::encrypt($search_id);

        $assigned->update(['search_id'=>$search_id]);
    }
}
