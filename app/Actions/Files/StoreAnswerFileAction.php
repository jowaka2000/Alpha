<?php

namespace App\Actions\Files;

use App\Models\Answer;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\File;


class StoreAnswerFileAction
{
    public function execute(array $files,Order $order){
        foreach($files as $file){
            $fileName= $file->hashName();
            $fileOriginalName= $file->getClientOriginalName();
            $fileSize = $file->getSize();

            Storage::putFileAs('answers',$file,$fileName);

            Answer::create([
                'order_id'=>$order->id,
                'file_name'=>$fileName,
                'file_original_name'=>$fileOriginalName,
                'file_size'=>$fileSize,
            ]);
        }
    }
}
