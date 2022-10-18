<?php

namespace App\Actions\Destroy;

use App\Models\Bid;
use App\Models\File;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class DeleteOrderAction
{
    public function execute(Order $order){
        $files = File::where('order_id',$order->id)->get();
        foreach($files as $file){
            $file->delete();
            Storage::delete('docs/'.$file->file_name);
        }

        $bids = Bid::where('order_id',$order->id)->where('status','biding')->get();

        foreach($bids as $bid){
            $bid->delete();
        }

        $order->delete();
    }
}
