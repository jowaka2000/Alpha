<?php

namespace App\Actions\Updates;

use App\Models\Completed;
use Illuminate\Http\Request;

class UpdateCompletedAction
{
    public function execute(Request $request,Completed $completed){
        $completed->update([
            'answer_type'=>$request->answer_type,
            'message'=>$request->message,
            'additional_information'=>$request->additional_information,
            'status'=>'pending'
         ]);
    }
}
