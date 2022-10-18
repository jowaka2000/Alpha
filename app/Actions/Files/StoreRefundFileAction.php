<?php

namespace App\Actions\Files;

use App\Models\Completed;
use Illuminate\Support\Facades\Storage;
use App\Models\Refund;


class StoreRefundFileAction
{

    public function execute(array $files,Completed $completed){

        foreach($files as $file){
            $fileName = $file->hashName();
            $fileOriginalName=$file->getClientOriginalName();

            Storage::putFileAs('refunds',$file,$fileName);

            Refund::create([
                'order_id'=>$completed->order->id,
                'file_name'=>$fileName,
                'file_original_name'=>$fileOriginalName,
            ]);
        }
    }
}
