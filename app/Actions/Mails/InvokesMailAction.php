<?php

namespace App\Actions\Mails;

use App\Jobs\SendAlert;
use App\Mail\InvitationAcceptanceMail;
use App\Models\Invoke;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class InvokesMailAction
{
    public function execute(User $user,Invoke $invoke, User $currentUser){

        $employers = json_decode($user->employers,true);

        if(($employers['employer1']==='') || ($employers['employer2']==='') || ($employers['employer3']==='')){
            $arr = array_search('',$employers);
            $employers[$arr] = auth()->user()->id;
            $employers = json_encode($employers);

            $user->update(['employers'=>$employers]);
        }else{
            return back();
        }

        $message1 = $currentUser->name.' has acceptend your request of becoming their employer. You can now view and take both private and public task orders from '.$currentUser->name;
        $message2 = 'You have accepted the request of '.$user->name.' of becoming your writer. You can now assign private and public task orders to '.$user->name.'.';
        $data1 =[
            'sender'=>$currentUser->id,
            'reciever'=>$user->id,
            'message'=>$message1,
            'model'=>'Invoke',
        ];
        $data2 =[
            'sender'=>$currentUser->id,
            'reciever'=>$currentUser->id,
            'message'=>$message2,
            'model'=>'Invoke',
        ];
        SendAlert::dispatch($data1);//sending alerts
        SendAlert::dispatch($data2);

          //sending first email
          $infoHeader1 = strtoupper(auth()->user()->name).' HAS ACCEPTED YOUR REQUEST!';
          $infoMessage1 =auth()->user()->name.' has acceptend your request of becoming their employer. You can now view and take both private and public task orders from '.$currentUser->name.' Check the button below and headover to the platform';
          $info1 = [
              'header'=>$infoHeader1,
              'message'=>$infoMessage1,
          ];

          Mail::to($invoke->user->email)->send(new InvitationAcceptanceMail($info1));
          //sending second email

          $infoHeader2 ='YOU HAVE ACCEPTED '.strtolower($invoke->user->name).'\' REQUEST';
          $infoMessage2 ='You have accepted the request of '.$invoke->user->name.' of becoming your writer. You can now assign them both private and public task orders anytime. Check below link and assign them orders';

          $info2 = [
              'header'=>$infoHeader2,
              'message'=>$infoMessage2,
          ];

          Mail::to($currentUser->email)->send(new InvitationAcceptanceMail($info2));

    }
}
