<?php

namespace App\Actions\Updates;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileUpdateAction
{
    public function execute(User $user,Request $request){

        $oldData = $user->old_profile_data;

        $oldData= json_decode($oldData,true);

        if($oldData==null){
            $oldData = $user->toArray();
        }else{
            array_push($oldData,$user->toArray());
        }

        if($user->number != $request->number){
            $user->update(['phone_verified'=>false]);
         }

         $user->update([
              'name'=>$request->name,
              'numbera'=>$request->number,
              'chanel'=>$request->chanel,
              'availability'=>$request->availability,
              'old_profile_data'=>json_encode($oldData),
          ]);
    }
}
