<?php

namespace App\Actions\Store;

use App\Models\Assigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StoreCompletedAction
{
    public function execute(Request $request,Assigned $assigned){

       $completed = $request->user()->completed()->create([
            'order_id' => $assigned->order->id,
            'employer_id' => $assigned->order->user_id,
            'answer_type' => $request->answer_type,
            'message' => $request->message,
            'additional_information' => $request->additional_information,
            'status' => 'pending',
            'topic' => $assigned->order->topic
        ]);


        $search_id = $completed->id.now()->diffInMilliseconds().',,'.now()->diffInMicroseconds().'....'.now()->diffInMinutes();
        $search_id = Crypt::encrypt($search_id);

        $completed->update(['search_id'=>$search_id]);

    }
}
