<?php

namespace App\Actions\Files;

use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\File;


class StoreOrderFileAction
{

    public function execute(array $files,Order $order){
        foreach($files as $file){
            $name = $file->hashName();
            $originalName= $file->getClientOriginalName();

            Storage::putFileAs('docs',$file, $name);
            File::create([
                'order_id'=>$order->id,
                'file_name'=>$name,
                'file_original_name'=>$originalName,
            ]);

        }
    }
}
