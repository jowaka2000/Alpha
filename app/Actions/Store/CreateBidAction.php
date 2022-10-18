<?php

namespace App\Actions\Store;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class CreateBidAction
{
    public function execute(User $user,Order $order){

        $employers = json_decode($user->employers, true);
        $var = array_search($order->user->id, $employers);

        $is_my_writer = false;
        if ($var) {
            $is_my_writer =true;
        }

        $bid = $user->bids()->create([
            'order_id' => $order->id,
            'employer_id' => $order->user->id,
            'name' => auth()->user()->name,
            'is_my_writer'=>$is_my_writer,
        ]);

        $bids = $order->bids + 1;
        $order->update(['bids' => $bids]);


        $search_id= $bid->id.now()->diffInMilliseconds().',,'.now()->diffInMinutes().',,'.now()->diffInHours();
        $search_id= Crypt::encrypt($search_id);

        $bid->update(['search_id'=>$search_id]);
    }
}
